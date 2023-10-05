<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupFormRequest extends FormRequest
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
            'name'=>'required|string|max:100|unique:groups',
            'description'=>'string|max:500',
            'image'=>'mimes:jpg,jpeg,bmp,png|max:10000',
            'contract'=>'required|mimetypes:application/pdf|max:10000',
        ];
    }
}
