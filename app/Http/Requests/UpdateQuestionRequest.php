<?php

namespace App\Http\Requests;

use App\Models\Question;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('question_edit');
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
            'priority'    => [
                'string',
                'required',
            ],
            'type'        => [
                'required',
            ],
        ];
    }
}
