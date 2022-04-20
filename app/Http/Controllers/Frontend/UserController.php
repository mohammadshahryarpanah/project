<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function showRegister()
    {
        return view('register');
    }

    public function register(UserRequest $request)
    {
        try {
            $register = new User();
            $register->phone_number = $request->phone_number;
            $register->name = $request->name;
            $register->email = $request->email;
            $register->password = Hash::make($request->password);
            $register->save();
            Session::flash('add_user', 'کاربر جدید با موفقیت اضافه شد');
            return redirect()->back();

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function showLogin()
    {
        return view('login');

    }


    public function login(LoginRequest $request)
    {
        try {
            $credentials = User::query()->where('phone_number',$request->phone_number)
                ->first();

            if (!$credentials || ! Hash::check($request->password,$credentials->password)){
                return back()->withErrors('شماره موبایل یا پسورد شما اشتباه می باشد');
            }
             if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password])){
                 return redirect('/admin/index');
             }

            }catch(\Exception $exception){

            return back()->withErrors($exception->getMessage());
        }

    }


}
