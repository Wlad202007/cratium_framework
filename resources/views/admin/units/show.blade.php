@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.unit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.id') }}
                        </th>
                        <td>
                            {{ $unit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.name') }}
                        </th>
                        <td>
                            {{ $unit->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Unit::TYPE_SELECT[$unit->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.managers') }}
                        </th>
                        <td>
                            @foreach($unit->managers as $key => $managers)
                                <span class="label label-info">{{ $managers->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.head') }}
                        </th>
                        <td>
                            {{ $unit->head->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
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
            <a class="nav-link" href="#unit_premises" role="tab" data-toggle="tab">
                {{ trans('cruds.premise.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#units_templates" role="tab" data-toggle="tab">
                {{ trans('cruds.template.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="unit_premises">
            @includeIf('admin.units.relationships.unitPremises', ['premises' => $unit->unitPremises])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_groups">
            @includeIf('admin.units.relationships.unitGroups', ['groups' => $unit->unitGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_documents">
            @includeIf('admin.units.relationships.unitDocuments', ['documents' => $unit->unitDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="units_templates">
            @includeIf('admin.units.relationships.unitsTemplates', ['templates' => $unit->unitsTemplates])
        </div>
    </div>
</div>

@endsection