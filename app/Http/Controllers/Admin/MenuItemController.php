<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\MenuItemTranslation;
use Illuminate\Http\Request;
use App\Models\Admin\MenuItem;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Mews\Purifier\Facades\Purifier;

class MenuItemController extends Controller
{
    public function store(Request $request)
    {
        foreach ($request->label as $key => $label) {
            MenuItem::updateOrCreate([
                'id' => $request->menuItemId[$key] ?? null,
            ], [
                'label' => $label,
                'url' => $request->url[$key],
                'menu_id' => $request->menuId,
                'position' => $request->position,
                'status' => $request->status,
            ]);
        }

        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('menu.index');
    }

    public function delete($id)
    {
        MenuItem::find($id)->delete();
        session()->flash('success', __('Successfully Deleted'));
        Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
