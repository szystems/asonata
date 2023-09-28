<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateFormRequest extends FormRequest
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
            'name'=>'required|max:191|unique:users',
            'phone'=>'max:191',
            'whatsapp'=>'max:20',
            'email'=>'required|string|email|max:255|unique:users',
            'address1'=>'max:191',
            'addres2'=>'max:191',
            'city'=>'max:191',
            'state'=>'max:191',
            'country'=>'max:191',
            'zipcode'=>'max:191',
            'description'=>'max:500',
            'phone'=>'max:191',
            'timezone'=>'required', 'timezone',
        ];
    }
}
