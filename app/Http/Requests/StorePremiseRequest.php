<?php

namespace App\Http\Requests;

use App\Models\Premise;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePremiseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('premise_create');
    }

    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'unit_id'  => [
                'required',
                'integer',
            ],
            'capacity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
