<?php

namespace App\Http\Requests;

use App\Models\Folder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFolderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('folder_create');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'users.*'  => [
                'integer',
            ],
            'users'    => [
                'array',
            ],
            'groups.*' => [
                'integer',
            ],
            'groups'   => [
                'array',
            ],
            'admin_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
