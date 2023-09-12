<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassFormRequest extends FormRequest
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
            'cycle_id'=>'required',
            'category_id'=>'required',
            'schedule_id'=>'required',
            'instructor_id'=>'required',
            'start_date'=>'date|required',
            'end_date'=>'date|required',
            'notes'=>'string|nullable',
            'inscription_payment'=>'required',
            'monthly_payment'=>'required',
            'badge'=>'required'
        ];
    }
}
