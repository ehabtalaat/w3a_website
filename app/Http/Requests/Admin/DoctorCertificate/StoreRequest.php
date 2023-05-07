<?php

namespace App\Http\Requests\Admin\DoctorCertificate;

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

        foreach (LaravelLocalization::getSupportedLocales() as 
        $localeCode => $properties) {
             $validators['title-' . $localeCode] = ['required']; 
             $validators['text-' . $localeCode] = ['required']; 
         } 
         $validators['image'] = ['mimes:jpeg,png,jpg,gif','max:1240']; 

        return  $validators;
    }
}
