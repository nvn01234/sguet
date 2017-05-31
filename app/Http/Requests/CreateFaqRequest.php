<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Entrust::can('manage-content');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required|string',
            'answer' => 'required|string',
            'tags' => 'array',
            'tags.*' => 'string|required',
            'paraphrases' => 'string'
        ];
    }
}
