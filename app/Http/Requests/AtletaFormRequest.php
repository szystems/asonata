<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtletaFormRequest extends FormRequest
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
            'cui_dpi'=>'required|string|unique:atleta',
            'name'=>'required|string|max:100',
            'image'=>'image|required|mimes:jpg,jpeg,bmp,png,gif,pdf|max:5000',
            'birth_certificate'=>'image|required|mimes:jpg,jpeg,bmp,png,gif,pdf|max:5000',
            'vaccination_card'=>'image|required|mimes:jpg,jpeg,bmp,png,gif,pdf|max:5000',
            'birth'=>'required|date',
            'gender'=>'required|integer',
            'doses_number'=>'required|string',
            'ethnic_group'=>'required|string',
            'education_obtained'=>'required|string',
            'tshirt_size'=>'required|string',
            'phone'=>'required|string|max:20',
            'whatsapp'=>'required|string|max:20',
            'email'=>'required', 'string', 'email', 'max:100',
            'address'=>'required|string|max:500',
            'city'=>'required|string|max:50',
            'state'=>'required|string|max:50',
            'country'=>'required|string|max:50',
            'status'=>'integer',
            'responsible_name'=>'required|string|max:100',
            'responsible_dpi'=>'required|integer',
            'responsible_image'=>'image|required|mimes:jpg,jpeg,bmp,png,gif,pdf|max:5000',
            'responsible_phone'=>'required|string|max:20',
            'responsible_whatsapp'=>'required|string|max:20',
            'responsible_email'=>'email|required|string|max:100',
            'responsible_address'=>'required|string|max:200',
            'kinship'=>'required|string',
            'responsible_doses_number'=>'required|string',
        ];
    }
}
