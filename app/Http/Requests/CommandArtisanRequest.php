<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandArtisanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Entrust::can('manage-system');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cmd' => 'string|required',
            'params' => 'string|nullable',
        ];
    }
}
