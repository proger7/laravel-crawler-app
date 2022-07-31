<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'v_url' => 'required',
            'v_site_url' => 'required',
            'v_content_type' => 'required',
            'v_filter_type' => 'required',
            'v_function' => 'required'
        ];
    }
}
