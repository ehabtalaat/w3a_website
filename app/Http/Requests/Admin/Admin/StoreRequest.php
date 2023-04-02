<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validators = [];

     
         $validators['image'] = ['required','mimes:jpeg,png,jpg,gif','max:1240']; 
         $validators['phone'] = ['required','unique:doctors']; 
         $validators['name'] = ['required']; 
         $validators['email'] = ['required']; 
         $validators['password'] = ['required','min:8']; 
     

        return  $validators;
    }
}
