<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSliderRequest extends FormRequest
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
            'image' => ['required', 'mimes:jpg,bmp,png,gif'],
            'icon' => 'required',
            'small_heading_en' => 'required',
            'big_heading_en' => 'required',
            'description_en' => 'required',
            'status' => 'required',
        ];
    }
}
