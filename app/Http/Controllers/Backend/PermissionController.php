<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Mime\to;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index',compact('permissions'));
    }


    public function create()
    {
        return view('admin.permissions.create');

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],


        ],[
            'name.required'=>'لطفا نام سطح دسترسی  را وارد کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $storeRole = new Permission();
            $storeRole->name = $request->name;
            $storeRole->save();
            Session::flash('add_permission','عملیات با موفقیت انجام شد');
            return redirect()->to(route('permission.index'));
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($permission_id)
    {
        $permission = Permission::find($permission_id);
        return view('admin.permissions.edit',compact('permission'));
    }

    public function update($permission_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],

        ],[
            'name.required'=>'لطفا نام سطح دسترسی را وارد کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


        try {

            $permission = Permission::query()->where('id',$permission_id)->update([
                'name'=>$request->name
            ]);

            Session::flash('update_permission','عملیات با موفقیت انجام شد');
            return redirect()->to(route('permission.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($permission_id)
    {
        try {
            $permission= Permission::destroy($permission_id);
            if (!$permission){
                return back()->withErrors('سطح دسترسی مورد نظر یافت نشد');
            }
            Session::flash('delete_permission','عملیات با موفقیت انجام شد');
            return redirect()->to(route('permission.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }
}
