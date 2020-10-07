<?php

namespace App\Http\Requests;

use App\Models\Document;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('document_create');
    }

    public function rules()
    {
        return [
            'int_number' => [
                'string',
                'nullable',
            ],
            'ext_number' => [
                'string',
                'nullable',
            ],
            'title'      => [
                'string',
                'required',
            ],
            'unit_id'    => [
                'required',
                'integer',
            ],
            'author_id'  => [
                'required',
                'integer',
            ],
            'type'       => [
                'required',
            ],
            'status'     => [
                'required',
            ],
            'shares.*'   => [
                'integer',
            ],
            'shares'     => [
                'array',
            ],
            'folders.*'  => [
                'integer',
            ],
            'folders'    => [
                'array',
            ],
        ];
    }
}
