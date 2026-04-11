<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaFormRequest extends FormRequest
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
            'titulo'=>'required',
            'imagen'=>'nullable|image|mimes:jpg,jpeg,bmp,png,gif,webp|max:3000',
            'contenido'=>'required',
        ];
    }
}
