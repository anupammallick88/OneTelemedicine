<?php

namespace App\Http\Controllers\Front;

use App\Models\Admin\Gallery;
use App\Models\Front\ServiceTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Front\Service;
use App\DataTables\ServiceDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Mews\Purifier\Facades\Purifier;

class ServiceController extends Controller
{
    public function index(ServiceDatatable $dataTable)
    {
        return $dataTable->render('front.sections.service.index');
    }

    public function create()
    {
        return view('front.sections.service.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'icon' => 'required',
            'title_en' => 'required:unique:services',
            'description_en' => 'required',
            'details_en' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->image)) {
                $image = uploadFile($request['image'], SERVICE_IMG); // upload file
            }

            if (!empty($request->icon)) {
                $icon = fileUpload($request['icon'], SERVICE_IMG); // upload file
            }
            $create = Service::create([
                'image' => $image,
                'icon' => $icon,
                'tags' => $request->tags,
                'status' => $request->status,
                'user_id' => Auth::id(),
            ]);
            if(!empty($create)) {
                foreach(allLanguages() as $lang) {
                    ServiceTranslation::create([
                        'locale' => $lang->prefix,
                        'service_id' => $create->id,
                        'title' => is_null($request->input('title_'.$lang->prefix)) ? $request->input('title_en') : $request->input('title_'.$lang->prefix),
                        'details' => is_null($request->input('details_'.$lang->prefix)) ? $request->input('details_en') : $request->input('details_'.$lang->prefix),
                        'description' => is_null($request->input('description_'.$lang->prefix)) ? $request->input('description_en') : $request->input('description_'.$lang->prefix),
                    ]);
                }
            }
        }catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->route('service.index')->with('success', __('Slider added successfully!'));
    }

    public function edit($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        return view('front.sections.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        DB::beginTransaction();
        try {
            if(!empty($request->image)){
                $image = fileUpload($request['image'], SERVICE_IMG);
            }
            else{
                $image = $service->image;
            }
            if(!empty($request->icon)){
                $icon = fileUpload($request['icon'], SERVICE_IMG);
            }
            else{
                $icon = $service->icon;
            }
            $update = Service::where('id', $id)->update([
                'image' => $image,
                'icon' => $icon,
                'tags' => is_null($request->tags) ? $service->tags : $request->tags,
                'status' => is_null($request->status) ? $service->status : $request->status,
                'user_id' => Auth::id(),
            ]);
            if(!empty($update)) {
                foreach (allLanguages() as $lang) {
                    ServiceTranslation::where('locale', $lang->prefix)->where('service_id', $service->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'service_id' => $service->id,
                    ],[
                        'title' => is_null($request->input('title_'.$lang->prefix)) ? $service->translateOrDefault($lang->prefix)->title : $request->input('title_'.$lang->prefix),
                        'details' => is_null($request->input('details_'.$lang->prefix)) ? $service->translateOrDefault($lang->prefix)->details : $request->input('details_'.$lang->prefix),
                        'description' => is_null($request->input('description_'.$lang->prefix)) ? $service->translateOrDefault($lang->prefix)->description : $request->input('description_'.$lang->prefix),
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

    public function delete($id)
    {
        $service = Service::where('id', $id)->firstOrFail();
        Gallery::where('service_id', $service->id)->delete();
        $image_path = public_path(path_service_image() . $service->image);
        if (File::exists($image_path)) {
            File::delete(public_path(path_service_image() . $service->image));
            File::delete(public_path(path_service_image() . $service->icon));
        }

        $service->delete();

        session()->flash('success', __('Successfully deleted'));
        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('service.index');
    }
}
