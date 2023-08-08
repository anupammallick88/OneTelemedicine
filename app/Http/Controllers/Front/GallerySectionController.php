<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Front\GallerySection;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class GallerySectionController extends Controller
{
    public function index()
    {
        if(GallerySection::first()) {
            $gallery = GallerySection::first();
        } else {
            $gallery = null;
        }
        return view('front.sections.gallery.index', compact('gallery'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $gallery = new GallerySection();

        if (!empty($request->image)) {
            $gallery->image = fileUpload($request['image'], path_gallery_image()); // upload file
         }

        $gallery->save();

        session()->flash('success', __('Successfully created'));
        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $request->validate([
            'image' => 'required',
        ]);

        $gallery = GallerySection::first();

        if (!empty($request->image)) {
            $old_img = '';
            $file = GallerySection::where('id', $gallery->id)->first();
            $old_img = isset($file) ? $file->image : '';

            $gallery->image = fileUpload($request['image'], path_gallery_image(), $old_img); // upload file
        }

        $gallery->save();

        session()->flash('success', __('Successfully updated'));
        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
