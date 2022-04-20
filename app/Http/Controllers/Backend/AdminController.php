<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\ValidMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function show()
    {
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }


    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }


    public function store(Request $request)
    {


        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'phone_number'=>['required',new ValidMobile()],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','string'],
            'role_ids'=>['required','array'],
            'role_ids.*'=>['required','exists:roles,id'],

        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',
            'phone_number.required'=>'لطفا شماره موبایل را وارد کنید',
            'email.required'=>'لطفا ایمیل را وارد کنید',
            'password.required'=>'لطفا پسورد را وارد کنید',

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->attach($request->role_ids);
            DB::commit();
            Session::flash('add_user', 'کاربر جدید با موفقیت اضافه شد');
            return redirect()->to(route('admin.index'));

        }catch(\Exception $exception){
            DB::rollBack();
            return back()->withErrors($exception->getMessage());
        }
    }

    public function destroy($user_id)
    {
        try {

            $user = User::destroy($user_id);
            if (!$user){
                return back()->withErrors('کاربر مورد نظر یافت نشد');
            }
            Session::flash('delete_user','کاربر با موفقیت حذف شد');
            return redirect()->to(route('admin.index'));


        }catch(\Exception $exception){

            return back()->withErrors($exception->getMessage());
        }

    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $roles = Role::all();
        return view('admin.users.edit',compact('user','roles'));

    }

    public function update($user_id,Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'phone_number'=>['required',new ValidMobile()],
            'email'=>['required','email','unique:users,email,'.$user_id],
            'password'=>['required','string'],
            'role_ids'=>['required','array'],
            'role_ids.*'=>['required','exists:roles,id'],

        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',
            'phone_number.required'=>'لطفا شماره موبایل را وارد کنید',
            'email.required'=>'لطفا ایمیل را وارد کنید',
            'email.unique'=>'ایمیل تکراری می باشد',
            'password.required'=>'لطفا پسورد را وارد کنید',

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


            try {

                $checkUser = User::query()->where('id', $user_id)->exists();
                if (!$checkUser) {
                    return back()->withErrors('کاربر مورد نظر یافت نشد');
                }

                DB::beginTransaction();
                $user = User::find($user_id);
                $user->name = $request->name;
                $user->phone_number = $request->phone_number;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                $user->roles()->sync($request->role_ids);
                DB::commit();
                Session::flash('update_user','کاربر با موفقیت بروزرسانی شد');
                return redirect()->to(route('admin.index'));


            } catch (\Exception $exception) {
                return back()->withErrors($exception->getMessage());
            }
        }



}
