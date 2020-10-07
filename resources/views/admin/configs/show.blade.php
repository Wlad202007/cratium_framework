@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.config.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.config.fields.id') }}
                        </th>
                        <td>
                            {{ $config->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.config.fields.term') }}
                        </th>
                        <td>
                            {{ $config->term }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.config.fields.value') }}
                        </th>
                        <td>
                            {{ $config->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.config.fields.parent') }}
                        </th>
                        <td>
                            {{ $config->parent->term ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#parent_configs" role="tab" data-toggle="tab">
                {{ trans('cruds.config.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_configs">
            @includeIf('admin.configs.relationships.parentConfigs', ['configs' => $config->parentConfigs])
        </div>
    </div>
</div>

@endsection