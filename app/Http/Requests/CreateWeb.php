<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWeb extends FormRequest
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
            'token_id' => 'required',
            'id_page' => 'required',
            'domain' => 'required',
            'page_name' => 'required',
            'id_ads' => 'required',
            'id_analytics' => 'required',
            'web_name' => 'required',
        ];
    }
}
