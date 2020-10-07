<?php

namespace App\Http\Requests;

use App\Models\Group;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGroupRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('group_edit');
    }

    public function rules()
    {
        return [
            'name'      => [
                'string',
                'required',
            ],
            'unit_id'   => [
                'required',
                'integer',
            ],
            'members.*' => [
                'integer',
            ],
            'members'   => [
                'array',
            ],
        ];
    }
}
