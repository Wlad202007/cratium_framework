<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name'            => [
                'string',
                'required',
            ],
            'last_name'       => [
                'string',
                'nullable',
            ],
            'middle_name'     => [
                'string',
                'nullable',
            ],
            'academic_status' => [
                'string',
                'nullable',
            ],
            'position'        => [
                'string',
                'nullable',
            ],
            'phone'           => [
                'string',
                'nullable',
            ],
            'email'           => [
                'required',
                'unique:users',
            ],
            'password'        => [
                'required',
            ],
            'roles.*'         => [
                'integer',
            ],
            'roles'           => [
                'required',
                'array',
            ],
        ];
    }
}
