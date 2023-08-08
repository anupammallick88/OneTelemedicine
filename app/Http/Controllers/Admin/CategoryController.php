<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\CategoryTranslation;
use App\Models\Admin\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\DataTables\CategoryDatatable;
use Mews\Purifier\Facades\Purifier;

class CategoryController extends Controller
{
    public function index(CategoryDatatable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $create = Category::create([
                'status' => 1,
            ]);
            if (!empty($create)) {
                foreach (allLanguages() as $lang) {
                    CategoryTranslation::create([
                        'locale' => $lang->prefix,
                        'category_id' => $create->id,
                        'name' => is_null($request->input('name_' . $lang->prefix)) ? $request->input('name_en') : $request->input('name_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->route('category.index')->with('success', __('Category added successfully!'));
    }


    public function edit($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $id)->firstOrFail();

        DB::beginTransaction();
        try {
            $update = Category::where('id', $id)->update([
                'status' => is_null($request->status) ? $category->status : $request->status,
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    CategoryTranslation::where('locale', $lang->prefix)->where('category_id', $category->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'category_id' => $category->id,
                    ], [
                        'name' => is_null($request->input('name_' . $lang->prefix)) ? $category->translateOrDefault($lang->prefix)->name : $request->input('name_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->back()->with('success', __('Successfully updated!'));



        $category->name = Purifier::clean($request->name);
        $category->slug = Str::slug(Purifier::clean($request->name));
        $category->save();

        session()->flash('success', __('Successfully updated'));
        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('category.index');
    }


    public function delete($id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        if (News::where('category_id', $id)->first()) {
            session()->flash('success', __('This category has news'));
            Toastr::warning('warning', __('This category has news'), ["positionClass" => "toast-top-right"]);
        } else {
            $category->delete();
            session()->flash('success', __('Successfully updated'));
            Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);
        }

        return redirect()->route('category.index');
    }
}
