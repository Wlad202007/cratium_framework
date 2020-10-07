<?php

namespace App\Http\Requests;

use App\Models\Bill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_edit');
    }

    public function rules()
    {
        return [
            'amount'    => [
                'required',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
            'unit_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
