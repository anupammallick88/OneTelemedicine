<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\News;
use App\Models\Admin\NewsTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\DataTables\NewsDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class NewsController extends Controller
{
    public function index(NewsDatatable $dataTable)
    {
        return $dataTable->render('admin.news.index');
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string',
            'description_en' => 'required|string',
            'details_en' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,webp,gif',
            'image_alt' => 'required|string',
            'tags' => 'required|string',
            'category_id' => 'required',
            'status' => 'required',
        ], [
            'category_id.required' => __('The category field is required'),
        ]);

        try {
            if (!empty($request->image)) {
                $image = uploadFile($request['image'], NEWS_IMG); // upload file
            }
            $create = News::create([
                'image' => $image,
                'image_alt' => $request->image_alt,
                'tags' => $request->tags,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'user_id' => Auth::id(),
            ]);
            if (!empty($create)) {
                foreach (allLanguages() as $lang) {
                    NewsTranslation::create([
                        'locale' => $lang->prefix,
                        'news_id' => $create->id,
                        'title' => is_null($request->input('title_' . $lang->prefix)) ? $request->input('title_en') : $request->input('title_' . $lang->prefix),
                        'details' => is_null($request->input('details_' . $lang->prefix)) ? $request->input('details_en') : $request->input('details_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $request->input('description_en') : $request->input('description_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        return redirect()->route('news.index')->with('success', __('News added successfully!'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $news = News::where('id', $id)->firstOrFail();
        return view('admin.news.edit', compact('news', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $news = News::where('id', $id)->firstOrFail();
        $request->validate([
            'image' => 'mimes:jpg,bmp,png,gif',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->image)) {
                $image = fileUpload($request['image'], NEWS_IMG);
            } else {
                $image = $news->image;
            }
            $update = News::where('id', $id)->update([
                'image' => $image,
                'image_alt' => is_null($request->image_alt) ? $news->image_alt : $request->image_alt,
                'tags' => is_null($request->tags) ? $news->tags : $request->tags,
                'category_id' => is_null($request->category_id) ? $news->category_id : $request->category_id,
                'status' => is_null($request->status) ? $news->status : $request->status,
                'user_id' => Auth::id(),
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    NewsTranslation::where('locale', $lang->prefix)->where('news_id', $news->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'news_id' => $news->id,
                    ], [
                        'title' => is_null($request->input('title_' . $lang->prefix)) ? $news->translateOrDefault($lang->prefix)->title : $request->input('title_' . $lang->prefix),
                        'details' => is_null($request->input('details_' . $lang->prefix)) ? $news->translateOrDefault($lang->prefix)->details : $request->input('details_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $news->translateOrDefault($lang->prefix)->description : $request->input('description_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->route('news.index')->with('success', __('Successfully updated!'));
    }

    public function delete($id)
    {
        $news = News::where('id', $id)->firstOrFail();
        $image_path = public_path(path_news_image() . $news->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $news->delete();
        session()->flash('success', __('Successfully delete'));
        Toastr::success('success', __('Successfully delete'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('news.index');
    }
}
