<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'group_id'=>'integer',
            'name'=>'required|string|max:100',
            'age_from'=>'string|max:5',
            'age_to'=>'string|max:5',
            'requirements'=>'string|nullable',
            'implements'=>'string|nullable',
            'description'=>'string|nullable',
            'image'=>'mimes:jpg,jpeg,bmp,png|max:3000',
            'contract'=>'mimetypes:application/pdf|max:3000',
        ];
    }
}
