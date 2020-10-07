<?php

namespace App\Http\Requests;

use App\Models\Score;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateScoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('score_edit');
    }

    public function rules()
    {
        return [
            'value'      => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'model'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'model_type' => [
                'string',
                'nullable',
            ],
            'author_id'  => [
                'required',
                'integer',
            ],
            'user_id'    => [
                'required',
                'integer',
            ],
        ];
    }
}
