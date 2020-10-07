<?php

namespace App\Http\Requests;

use App\Models\Activity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('activity_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'type'          => [
                'required',
            ],
            'score'         => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'duration'      => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'time_start'    => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'time_end'      => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'test_per_page' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'time_per_test' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mode'          => [
                'required',
            ],
            'moderator_id'  => [
                'required',
                'integer',
            ],
        ];
    }
}
