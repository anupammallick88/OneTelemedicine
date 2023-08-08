<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\Social;
use Illuminate\Http\Request;
use App\DataTables\SocialDatatable;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Mews\Purifier\Facades\Purifier;

class SocialController extends Controller
{
    public function index(SocialDatatable $dataTable)
    {
        return $dataTable->render('front.sections.social.index');
    }

    public function create()
    {
        return view('front.sections.social.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'class' => 'required',
        ]);

        $social = new Social();
        $social->name = Purifier::clean($request->name);
        $social->url = Purifier::clean($request->url);
        $social->class = Purifier::clean($request->class);

        $social->save();
        session()->flash('success', __('Successfully created'));

        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('site.social.index');
    }

    public function edit($id)
    {
        $social = Social::where('id', $id)->firstOrFail();
        return view('front.sections.social.edit', compact('social'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'class' => 'required',
        ]);

        $social = Social::where('id', $id)->firstOrFail();
        $social->name = Purifier::clean($request->name);
        $social->url = Purifier::clean($request->url);
        $social->class = Purifier::clean($request->class);

        $social->save();
        session()->flash('success', __('Successfully updated'));

        Toastr::success('success', __('Successfully updated'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('site.social.index');
    }

    public function delete($id)
    {
        $social = Social::where('id', $id)->firstOrFail();
        $social->delete();
        session()->flash('success', __('Successfully deleted'));

        Toastr::success('success', __('Successfully deleted'), ["positionClass" => "toast-top-right"]);

        return redirect()->route('site.social.index');
    }
}
