<?php

namespace App\Http\Requests;

use App\Models\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_create');
    }

    public function rules()
    {
        return [
            'question'    => [
                'string',
                'max:1200',
                'required',
            ],
            'score'       => [
                'numeric',
            ],
            'activity_id' => [
                'required',
                'integer',
            ],
            'status'      => [
                'required',
            ],
            'type'        => [
                'required',
            ],
        ];
    }
}
