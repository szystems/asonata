<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionFormRequest extends FormRequest
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
            'video_fondo'=>'nullable|image|mimes:jpg,jpeg,bmp,png,gif,pdf|max:3000',
            'video_link'=>'nullable|url',
            'nosotros_imagen'=>'nullable|image|mimes:jpg,jpeg,bmp,png,gif,pdf|max:3000',
        ];
    }
}
