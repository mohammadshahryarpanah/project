<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index',compact('cities'));
    }


    public function create()
    {
       return view('admin.cities.create');

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'status'=>['required','boolean'],

        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',
            'status.required'=>'لطفا وضعیت  را مشخص کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $storeCity = new City();
            $storeCity->name = $request->name;
            $storeCity->status = $request->status;
            $storeCity->save();
//            return response()->json(['success'=>'Successfully']);
//            Session::flash('add_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('city.index'));
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($city_id)
    {
        $city = City::find($city_id);
        return view('admin.cities.edit',compact('city'));
    }

    public function update($city_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'status'=>['required','boolean'],


        ],[
            'name.required'=>'لطفا نام  را وارد کنید .',
            'status.required'=>'لطفا وضعیت  را مشخص کنید .',

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }


        try {
            $updateCity= City::query()->where('id',$city_id)->update([
               'name'=>$request->name,
               'status'=>$request->status,
            ]);
            Session::flash('update_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('city.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($city_id)
    {
        try {
            $city = City::destroy($city_id);
            if (!$city){
                return back()->withErrors('شهر مورد نظر یافت نشد');
            }
            Session::flash('delete_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('city.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }


}
