<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Permission_Role;
use App\Models\Role;
use App\Rules\ValidMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'permission_ids'=>['required','array'],
            'permission_ids.*'=>['required','exists:permissions,id'],

        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            DB::beginTransaction();
            $storeRole = new Role();
            $storeRole->name = $request->name;
            $storeRole->save();
            $storeRole->permissions()->sync($request->permission_ids);
            DB::commit();
            Session::flash('add_role','عملیات با موفقیت انجام شد');
            return redirect()->to('/admin/index/role');
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($role_id)
    {
        $role = Role::find($role_id);
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    public function update($role_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'permission_ids'=>['required','array'],
            'permission_ids.*'=>['required','exists:permissions,id'],

        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


        try {
            DB::beginTransaction();
            $updateRole = Role::find($role_id);
            $updateRole->name = $request->name;
            $updateRole->save();
            $updateRole->permissions()->sync($request->permission_ids);
            DB::commit();
            Session::flash('update_role','عملیات با موفقیت انجام شد');
            return redirect()->to('/admin/index/role');

        }catch (\Exception $exception){
            DB::rollBack();
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($role_id)
    {
        try {
            $role = Role::destroy($role_id);
            if (!$role){
                return back()->withErrors('نقش مورد نظر یافت نشد');
            }
            Session::flash('delete_role','عملیات با موفقیت انجام شد');
            return redirect()->to('/admin/index/role');

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }


}
