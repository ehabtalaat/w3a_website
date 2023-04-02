<?php

namespace App\Http\Requests\Admin\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UpdateRequest extends FormRequest
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
              $validators['description-' . $localeCode] = ['required']; 
              $validators['mini_description-' . $localeCode] = ['required']; 
          } 
          $validators['image'] = ['mimes:jpeg,png,jpg,gif','max:1240']; 
          $validators['phone'] = ['required','unique:doctors,phone,' . $this->doctor]; 

          $validators['name'] = ['required']; 
          $validators['email'] = ['required']; 
          $validators['password'] = ['nullable','min:8']; 

        return  $validators;
    }
}
