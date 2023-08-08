<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\Brand;
use Illuminate\Http\Request;
use App\DataTables\BrandDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function index(BrandDatatable $dataTable)
    {
       return $dataTable->render('front.sections.brand.index');
    }
    public function create()
    {
        return view('front.sections.brand.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $brand = new Brand();

        if (!empty($request->image)) {
            $brand->image = fileUpload($request['image'], path_brand_image()); // upload file
         }

        $brand->save();

        session()->flash('success', __('Successfully created'));
        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('brand.index');

    }
    public function edit($id)
    {
        $brand = Brand::where('id', $id)->firstOrFail();
        return view('front.sections.brand.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::where('id', $id)->firstOrFail();

        $request->validate([
            'image' => 'required',
        ]);


        if (!empty($request->image)) {
            $old_img = '';
            $file = Brand::where('id', $id)->first();
            $old_img = isset($file) ? $file->image : '';

            $brand->image = fileUpload($request['image'], path_brand_image(), $old_img); // upload file
        }

        $brand->save();

        session()->flash('success', __('Successfully update'));
        Toastr::success('success', __('Successfully update'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('brand.index');
    }
    public function delete($id)
    {
        $brand = Brand::where('id', $id)->firstOrFail();
        $image_path = public_path(path_brand_image() . $brand->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $brand->delete();

        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('brand.index');
    }
}
