<?php

namespace App\Http\Requests;

use App\Models\Answer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAnswerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('answer_edit');
    }

    public function rules()
    {
        return [
            'user_id'    => [
                'required',
                'integer',
            ],
            'variant_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
