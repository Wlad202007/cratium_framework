@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.signature.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signatures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.signature.fields.id') }}
                        </th>
                        <td>
                            {{ $signature->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signature.fields.user') }}
                        </th>
                        <td>
                            {{ $signature->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signature.fields.document') }}
                        </th>
                        <td>
                            {{ $signature->document->int_number ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signature.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Signature::STATUS_SELECT[$signature->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signatures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection