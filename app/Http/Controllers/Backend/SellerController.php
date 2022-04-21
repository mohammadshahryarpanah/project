<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\seller_type;
use App\services\ImageFileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{

    public function index()
    {
        $sellers = Seller::all();
        return view('admin.sellers.index',compact('sellers'));
    }


    public function create()
    {
        $seller_type = seller_type::all();
        return view('admin.sellers.create',compact('seller_type'));

    }

    public function store(Request $request)
    {

        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'seller_type_id'=>['required','exists:seller_type,id'],
            'description'=>['required','string'],
            'address'=>['required'],
            'image'=>['required','file','mimes:png,jpg'],
            'logo'=>['required','file','mimes:png,jpg'],
            'phone_number'=>['required','string'],


        ],[

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }
        try {

            $storeSeller = new Seller();
            $storeSeller->name = $request->name;
            $storeSeller->seller_type_id = $request->seller_type_id;
            $storeSeller->description = $request->description;
            $storeSeller->address = $request->address;
            $storeSeller->phone_number = $request->phone_number;
            $storeSeller->background_image = ImageFileService::upload($request->image);
            $storeSeller->logo = ImageFileService::upload($request->logo);
            $storeSeller->save();
            return redirect()->to(route('seller.index'));
        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }
    }


    public function edit($seller_id)
    {
        $seller = Seller::find($seller_id);
        $seller_type = seller_type::all();

        return view('admin.sellers.edit',compact('seller','seller_type'));
    }

    public function update($seller_id,Request $request)
    {
        $validate_data = Validator::make($request->all(),[

            'name'=>['required','string'],
            'seller_type_id'=>['required','exists:seller_type,id'],
            'description'=>['required','string'],
            'address'=>['required'],
            'image'=>['required','file','mimes:png,jpg'],
            'logo'=>['required','file','mimes:png,jpg'],


        ],[

        ]);

        if($validate_data->fails()){
            $this->errors = $validate_data->errors()->all();
            return back()->withErrors($this->errors);
        }



        try {

            $updateSeller = Seller::find($seller_id);
            if (!$updateSeller){
                return back()->withErrors(' فروشنده مورد نظر یافت نشد');
            }
            $updateSeller->name = $request->name;
            $updateSeller->seller_type_id = $request->seller_type_id;
            $updateSeller->description = $request->description;
            $updateSeller->address = $request->address;
            $updateSeller->background_image = ImageFileService::upload($request->image);
            $updateSeller->logo = ImageFileService::upload($request->logo);
            $updateSeller->save();
            return redirect()->to(route('seller.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

    public function destroy($seller_id)
    {
        try {
            $seller = Seller::destroy($seller_id);
            if (!$seller){
                return back()->withErrors(' فروشنده مورد نظر یافت نشد');
            }
            return redirect()->to(route('seller.index'));

        }catch (\Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

    }

}
