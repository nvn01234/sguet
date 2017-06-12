<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateContactRequest extends FormRequest
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
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
            'phone_cq' => 'string|nullable',
            'phone_nr' => 'string|nullable',
            'phone_dd' => 'string|nullable',
            'fax' => 'string|nullable',
            'email' => 'email|nullable',
            'parent_id' => [
                'nullable',
                Rule::in(Contact::pluck('id')->toArray())
            ]
        ];
    }
}
