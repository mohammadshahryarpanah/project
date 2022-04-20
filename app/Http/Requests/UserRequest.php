<?php

namespace App\Http\Requests;

use App\Rules\ValidMobile;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'phone_number'=>['required',new ValidMobile(),'unique:users,phone_number'],
            'email'=>['required','unique:users,email'],
            'password'=>'required'
        ];
    }

    public function messages()
    {

        return [

            'phone_number.required' => 'لطفا موبایل را وارد کنید',
            'phone_number.unique' => 'شماره موبایل قبلا ثبت شده',
            'email.required' => 'لطفا ایمیل را وارد کنید',
            'email.unique' => 'ایمیل تکراری می باشد',
            'password.required' => 'لطفا پسورد را وارد کنید',


        ];

    }
}
