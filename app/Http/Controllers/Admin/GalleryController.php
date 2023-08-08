<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Gallery;
use App\Models\Front\Service;
use App\DataTables\GalleryDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class GalleryController extends Controller
{
    public function index(GalleryDatatable $dataTable)
    {
        $gallery = Gallery::all();
        return $dataTable->render('admin.gallery.index', compact('gallery'));
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.gallery.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $gallery = new Gallery();

        if (!empty($request->image)) {
            $gallery->image = fileUpload($request['image'], path_gallery_image()); // upload file
        }

        $gallery->service_id = Purifier::clean($request->service_id);

        $gallery->save();

        session()->flash('success', __('Successfully added'));
        Toastr::success('success', __('Successfully added'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('gallery.index');
    }


    public function edit($id)
    {
        $gallery = Gallery::where('id', $id)->firstOrFail();
        $services = Service::all();
        return view('admin.gallery.edit', compact('gallery', 'services'));
    }


    public function update(Request $request, $id)
    {
        $gallery = Gallery::where('id', $id)->firstOrFail();

        if (!empty($request->image)) {
            $old_img = '';
            $file = Gallery::where('id', $id)->first();
            $old_img = isset($file) ? $file->image : '';

            $gallery->image = fileUpload($request['image'], path_gallery_image(), $old_img); // upload file
        }

        $gallery->service_id = Purifier::clean($request->service_id);
        $gallery->save();

        session()->flash('success', __('Successfully updated'));
        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('gallery.index');
    }

    public function delete($id)
    {
        $gallery = Gallery::where('id', $id)->firstOrFail();
        $image_path = public_path(path_gallery_image() . $gallery->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $gallery->delete();

        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('gallery.index');
    }
}
