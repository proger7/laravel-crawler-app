<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ConfigurationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'siteurl' => 'required',
            'contenttype' => 'required',
            'filterfunction' => 'required',
            'filtertype' => 'required',
            'itemUrl' => 'required'
        ];
    }

}
