<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\AddSliderRequest;
use App\Models\Slider;
use App\Models\SliderTranslation;
use Illuminate\Http\Request;
use App\DataTables\SliderDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class SliderController extends Controller
{
    public function index(SliderDatatable $dataTable)
    {
        return $dataTable->render('front.sections.slider.index');
    }

    public function create()
    {
        return view('front.sections.slider.create');
    }


    public function store(AddSliderRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->image)) {
                $silder_image = uploadFile($request['image'], SLIDER_IMG); // upload file
            }
            $create = Slider::create([
                'image' => $silder_image,
                'icon' => $request->icon,
                'status' => $request->status,
                'user_id' => Auth::id(),
            ]);
            if (!empty($create)) {
                foreach (allLanguages() as $lang) {
                    SliderTranslation::create([
                        'locale' => $lang->prefix,
                        'slider_id' => $create->id,
                        'small_heading' => is_null($request->input('small_heading_' . $lang->prefix)) ? $request->input('small_heading_en') : $request->input('small_heading_' . $lang->prefix),
                        'big_heading' => is_null($request->input('big_heading_' . $lang->prefix)) ? $request->input('big_heading_en') : $request->input('big_heading_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $request->input('description_en') : $request->input('description_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->route('slider.index')->with('success', __('Slider added successfully!'));
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();

        return view('front.sections.slider.edit', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();
        $request->validate([
            'image' => 'mimes:jpg,bmp,png,gif',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->image)) {
                $image = fileUpload($request['image'], SLIDER_IMG);
            } else {
                $image = $slider->image;
            }
            $update = Slider::where('id', $id)->update([
                'icon' => is_null($request->icon) ? $slider->icon : $request->icon,
                'status' => is_null($request->status) ? $slider->status : $request->status,
                'image' => $image,
            ]);
            if (!empty($update)) {
                foreach (allLanguages() as $lang) {
                    SliderTranslation::where('locale', $lang->prefix)->where('slider_id', $slider->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'slider_id' => $slider->id,
                    ], [
                        'small_heading' => is_null($request->input('small_heading_' . $lang->prefix)) ? $slider->translateOrDefault($lang->prefix)->small_heading : $request->input('small_heading_' . $lang->prefix),
                        'big_heading' => is_null($request->input('big_heading_' . $lang->prefix)) ? $slider->translateOrDefault($lang->prefix)->big_heading : $request->input('big_heading_' . $lang->prefix),
                        'description' => is_null($request->input('description_' . $lang->prefix)) ? $slider->translateOrDefault($lang->prefix)->description : $request->input('description_' . $lang->prefix),
                    ]);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->back()->with('success', __('Successfully updated!'));
    }

    public function delete($id)
    {
        $slider = Slider::where('id', $id)->firstOrFail();
        $image_path = public_path(path_slider_image() . $slider->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $slider->delete();
        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('slider.index');
    }
}
