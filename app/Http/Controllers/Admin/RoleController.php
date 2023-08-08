<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDatatable;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(RolesDatatable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create', compact('permission'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        $role->syncPermissions($request->input('permission'));

        session()->flash('success', __('Successfully Created'));
        Toastr::success('success', __('Successfully Created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.role.index');
    }
    public function edit($id)
    {
        $data['role'] = Role::find($id);
        if ($data['role']['name'] == 'Super Admin') {
            session()->flash('error', __('Super Admin Can\'t Edit'));
            return redirect()->route('admin.role.index');
        }
        $data['permission'] = Permission::get();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        if ($role->name == 'Super Admin') {
            session()->flash('error', __('Super Admin Can\'t Update'));
            return redirect()->route('admin.role.index');
        }
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        session()->flash('success', __('Successfully Updated'));
        Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.role.index');
    }
    public function delete($id)
    {
        $role = Role::find($id);
        if ($role->name == 'Super Admin') {
            session()->flash('error', __('Super Admin Can\'t Delete'));
            return redirect()->route('admin.role.index');
        }
        DB::table("roles")->where('id', $id)->delete();
        session()->flash('success', __('Successfully Deleted'));
        Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('admin.role.index');
    }
}
