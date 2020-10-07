@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.template.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.id') }}
                        </th>
                        <td>
                            {{ $template->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.name') }}
                        </th>
                        <td>
                            {{ $template->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.body') }}
                        </th>
                        <td>
                            {!! $template->body !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.units') }}
                        </th>
                        <td>
                            @foreach($template->units as $key => $units)
                                <span class="label label-info">{{ $units->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection