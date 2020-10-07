<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_edit');
    }

    public function rules()
    {
        return [
            'name'       => [
                'string',
                'required',
            ],
            'type'       => [
                'required',
            ],
            'managers.*' => [
                'integer',
            ],
            'managers'   => [
                'array',
            ],
            'head_id'    => [
                'required',
                'integer',
            ],
        ];
    }
}
