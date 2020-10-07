<?php

namespace App\Http\Requests;

use App\Models\Score;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreScoreRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('score_create');
    }

    public function rules()
    {
        return [
            'value'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'author_id'   => [
                'required',
                'integer',
            ],
            'user_id'     => [
                'required',
                'integer',
            ],
            'activity_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
