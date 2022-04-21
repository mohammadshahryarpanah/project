<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\seller_type;
use App\services\ImageFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SellerTypeController extends Controller
{

    public function index()
    {
        $sellers = seller_type::all();
        return view('admin.seller_type.index',compact('sellers'));
    }


    public function create()
    {
        $cities = City::all();
        return view('admin.seller_type.create',compact('cities'));

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'title'=>['required','string'],
            'city_id'=>['required','exists:cities,id'],
            'description'=>['required','string'],
            'image'=>['required'],


        ],[
            'title.required'=>'لطفا عنوان  را وارد کنید .',
            'city_id.required'=>'لطفا عنوان  را وارد کنید .',
            'description.required'=>'لطفا عنوان  را وارد کنید .',
            'image.required'=>'لطفا تصویر را وارد کنید .',


        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $storeSellerType = new seller_type();
            $storeSellerType->title = $request->title;
            $storeSellerType->city_id = $request->city_id;
            $storeSellerType->description = $request->description;
            $storeSellerType->path = ImageFileService::upload($request->image);
            $storeSellerType->save();
            Session::flash('add_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('type.index'));
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($type_id)
    {
        $type = seller_type::find($type_id);
        $cities = City::all();

        return view('admin.seller_type.edit',compact('type','cities'));
    }

    public function update($type_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'title'=>['required','string'],
            'city_id'=>['required','exists:cities,id'],
            'description'=>['required'],
            'image'=>['required','file'],


        ],[
            'title.required'=>'لطفا عنوان  را وارد کنید .',
            'city_id.required'=>'لطفا عنوان  را وارد کنید .',
            'description.required'=>'لطفا عنوان  را وارد کنید .',
            'image.required'=>'لطفا تصویر را وارد کنید .'
        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }



        try {

            $updateSellerType = seller_type::find($type_id);
            if (!$updateSellerType){
                return back()->withErrors('نوع فروشنده مورد نظر یافت نشد');
            }

            if ($updateSellerType->path) {
                $filename = explode('/', $updateSellerType->path)[0];

                if (file_exists(storage_path('app/public/images') . DIRECTORY_SEPARATOR . $filename)) {
                    Storage::disk('public')->delete('app/public/images' . DIRECTORY_SEPARATOR . $filename);
                }
            }
            $updateSellerType->path = ImageFileService::upload($request->image);
            $updateSellerType->title = $request->title;
            $updateSellerType->description = $request->description;
            $updateSellerType->city_id = $request->city_id;
            $updateSellerType->save();
            Session::flash('update_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('type.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($type_id)
    {
        try {
            $type = seller_type::destroy($type_id);
            if (!$type){
                return back()->withErrors('نوع فروشنده مورد نظر یافت نشد');
            }
            Session::flash('delete_role','عملیات با موفقیت انجام شد');
            return redirect()->to(route('type.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

}
