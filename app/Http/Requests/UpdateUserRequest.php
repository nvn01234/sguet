<?php

namespace App\Http\Requests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /**
         * @var User $user
         */
        $user = $this->user();
        return $user && $user->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roles = Role::pluck('id')->toArray();
        $id = $this->route()->parameter('id');
        return [
            'name' => 'string|required',
            'username' => [
                'string', 'required',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'string|confirmed|nullable',
            'role_id' => [
                'required',
                Rule::in($roles)
            ]
        ];
    }
}
