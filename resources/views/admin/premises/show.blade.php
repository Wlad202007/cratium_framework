@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.premise.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.premises.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.id') }}
                        </th>
                        <td>
                            {{ $premise->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.name') }}
                        </th>
                        <td>
                            {{ $premise->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.unit') }}
                        </th>
                        <td>
                            {{ $premise->unit->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.capacity') }}
                        </th>
                        <td>
                            {{ $premise->capacity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Premise::TYPE_SELECT[$premise->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.address') }}
                        </th>
                        <td>
                            {{ $premise->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.premise.fields.gps') }}
                        </th>
                        <td>
                            {{ $premise->gps }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.premises.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection