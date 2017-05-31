<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Entrust::can('manage-user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roles = Role::lowerCurrentUser()->pluck('id')->toArray();
        return [
            'name' => 'string|required',
            'username' => 'string|required|unique:users',
            'password' => 'string|confirmed|required',
            'role_id' => [
                'required',
                Rule::in($roles)
            ]
        ];
    }
}
