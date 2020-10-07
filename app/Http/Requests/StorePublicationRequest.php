<?php

namespace App\Http\Requests;

use App\Models\Publication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePublicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('publication_create');
    }

    public function rules()
    {
        return [
            'title'          => [
                'string',
                'required',
            ],
            'date'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'edition'        => [
                'required',
            ],
            'url'            => [
                'string',
                'max:2000',
                'nullable',
            ],
            'author_id'      => [
                'required',
                'integer',
            ],
            'edition_number' => [
                'string',
                'nullable',
            ],
            'pages_count'    => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'location'       => [
                'string',
                'nullable',
            ],
            'type'           => [
                'required',
            ],
        ];
    }
}
