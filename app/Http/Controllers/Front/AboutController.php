<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\About;
use App\Models\Front\AboutTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class AboutController extends Controller
{
    public function index()
    {
        if(About::first()) {
            $about = About::first();
            return view('front.sections.about.index', compact('about'));
        } else {
            return view('front.sections.about.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'icon_one' => 'required',
            'icon_one_title' => 'required',
            'icon_one_description' => 'required',
            'icon_two' => 'required',
            'icon_two_title' => 'required',
            'icon_two_description' => 'required',
            'icon_three' => 'required',
            'icon_three_title' => 'required',
            'icon_three_description' => 'required',
        ]);

        $about = new About();

        $about->title = Purifier::clean($request->title);
        $about->description = Purifier::clean($request->description);
        $about->icon_one = $request->icon_one;
        $about->icon_one_title = Purifier::clean($request->icon_one_title);
        $about->icon_one_description = Purifier::clean($request->icon_one_description);
        $about->icon_two = $request->icon_two;
        $about->icon_two_title = Purifier::clean($request->icon_two_title);
        $about->icon_two_description = Purifier::clean($request->icon_two_description);
        $about->icon_three = $request->icon_three;
        $about->icon_three_title = Purifier::clean($request->icon_three_title);
        $about->icon_three_description = Purifier::clean($request->icon_three_description);

        if (!empty($request->image)) {
            $about->image = fileUpload($request['image'], path_about_image()); // upload file
         }

        $about->save();

        session()->flash('success', __('Successfully created'));

        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('about.index');

    }

    public function update(Request $request, $id)
    {
        $about = About::where('id', $id)->firstOrFail();
        $request->validate([
            'image' => 'mimes:jpg,bmp,png,gif',
        ]);

        DB::beginTransaction();
        try {
            if(!empty($request->image)){
                $image = fileUpload($request['image'], ABOUT_IMG);
            }
            else{
                $image = $about->image;
            }
            $update = About::where('id', $id)->update([
                'image' => $image,
                'icon_one' => is_null($request->icon_one) ? $about->icon_one : $request->icon_one,
                'icon_two' => is_null($request->icon_two) ? $about->icon_two : $request->icon_two,
                'icon_three' => is_null($request->icon_three) ? $about->icon_three : $request->icon_three,
            ]);
            if(!empty($update)) {
                foreach (allLanguages() as $lang) {
                    AboutTranslation::where('locale', $lang->prefix)->where('about_id', $about->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'about_id' => $about->id,
                    ],[
                        'title' => is_null($request->input('title_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->title : $request->input('title_'.$lang->prefix),
                        'description' => is_null($request->input('description_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->description : $request->input('description_'.$lang->prefix),
                        'icon_one_title' => is_null($request->input('icon_one_title_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_one_title : $request->input('icon_one_title_'.$lang->prefix),
                        'icon_one_description' => is_null($request->input('icon_one_description_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_one_description : $request->input('icon_one_description_'.$lang->prefix),
                        'icon_two_title' => is_null($request->input('icon_two_title_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_two_title : $request->input('icon_two_title_'.$lang->prefix),
                        'icon_two_description' => is_null($request->input('icon_two_description_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_two_description : $request->input('icon_two_description_'.$lang->prefix),
                        'icon_three_title' => is_null($request->input('icon_three_title_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_three_title : $request->input('icon_three_title_'.$lang->prefix),
                        'icon_three_description' => is_null($request->input('icon_three_description_'.$lang->prefix)) ? $about->translateOrDefault($lang->prefix)->icon_three_description : $request->input('icon_three_description_'.$lang->prefix),
                    ]);
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->back()->with('success', __('Successfully updated!'));
    }
}
