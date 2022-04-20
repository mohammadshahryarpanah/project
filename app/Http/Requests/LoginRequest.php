<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone_number'=>['required',new ValidMobile()],
            'password'=>'required'
        ];
    }

    public function messages()
    {

        return [

            'phone_number.required' => 'لطفا موبایل را وارد کنید',
            'password.required' => 'لطفا پسورد را وارد کنید',


        ];

    }


}
