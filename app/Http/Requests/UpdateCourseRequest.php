<?php

namespace App\Http\Requests;

use App\Models\Course;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_edit');
    }

    public function rules()
    {
        return [
            'name'      => [
                'string',
                'required',
            ],
            'authors.*' => [
                'integer',
            ],
            'authors'   => [
                'array',
            ],
            'status'    => [
                'required',
            ],
            'hours'     => [
                'numeric',
            ],
            'credits'   => [
                'numeric',
            ],
            'groups.*'  => [
                'integer',
            ],
            'groups'    => [
                'array',
            ],
            'video'     => [
                'string',
                'max:700',
                'nullable',
            ],
        ];
    }
}
