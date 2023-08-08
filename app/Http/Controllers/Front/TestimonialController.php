<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Front\Testimonial;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\DataTables\TestimonialDatatable;
use Mews\Purifier\Facades\Purifier;

class TestimonialController extends Controller
{
    public function index(TestimonialDatatable $dataTable)
    {
        return $dataTable->render('front.sections.testimonial.index');
    }
    public function create()
    {
        return view('front.sections.testimonial.create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp,gif',
            'name' => 'required',
            'occupation' => 'required',
            'title' => 'required',
            'description' => 'required',
            'star' => 'required',
            'status' => 'required',
        ]);

        $testimonial = new Testimonial();
        $testimonial->user_id = Auth::user()->id;

        if (!empty($request->image)) {
            $testimonial->image = fileUpload($request['image'], path_testimonial_image()); // upload file
        }

        $testimonial->name = Purifier::clean($request->name);
        $testimonial->occupation = Purifier::clean($request->occupation);
        $testimonial->title = Purifier::clean($request->title);
        $testimonial->description = Purifier::clean($request->description);
        $testimonial->star = Purifier::clean($request->star);
        $testimonial->status = Purifier::clean($request->status);

        $testimonial->save();

        session()->flash('success', __('Successfully created'));
        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('testimonial.index');
    }
    public function edit($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();
        return view('front.sections.testimonial.edit', compact('testimonial'));
    }
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'mimes:jpg,jpeg,png,webp,gif',
            'name' => 'required',
            'occupation' => 'required',
            'title' => 'required',
            'description' => 'required',
            'star' => 'required',
            'status' => 'required',
        ]);

        $testimonial->user_id = Auth::user()->id;
        $testimonial->name = Purifier::clean($request->name);
        $testimonial->occupation = Purifier::clean($request->occupation);
        $testimonial->title = Purifier::clean($request->title);
        $testimonial->description = Purifier::clean($request->description);
        $testimonial->star = Purifier::clean($request->star);
        $testimonial->status = Purifier::clean($request->status);

        if (!empty($request->image)) {
            $old_img = '';
            $file = Testimonial::where('id', $id)->first();
            $old_img = isset($file) ? $file->image : '';

            $testimonial->image = fileUpload($request['image'], path_testimonial_image(), $old_img); // upload file
        }

        $testimonial->save();

        session()->flash('success', __('Successfully updated'));
        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('testimonial.index');
    }
    public function delete($id)
    {
        $testimonial = Testimonial::where('id', $id)->firstOrFail();

        $image_path = public_path(path_testimonial_image() . $testimonial->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $testimonial->delete();

        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('testimonial.index');
    }
}
