@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.group.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.id') }}
                        </th>
                        <td>
                            {{ $group->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.name') }}
                        </th>
                        <td>
                            {{ $group->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.unit') }}
                        </th>
                        <td>
                            {{ $group->unit->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.members') }}
                        </th>
                        <td>
                            @foreach($group->members as $key => $members)
                                <span class="label label-info">{{ $members->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.description') }}
                        </th>
                        <td>
                            {!! $group->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.head') }}
                        </th>
                        <td>
                            {{ $group->head->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.parent') }}
                        </th>
                        <td>
                            {{ $group->parent->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.group.fields.contact_student') }}
                        </th>
                        <td>
                            {{ $group->contact_student->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.groups.index') }}">
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
            <a class="nav-link" href="#parent_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#groups_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#groups_folders" role="tab" data-toggle="tab">
                {{ trans('cruds.folder.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_groups">
            @includeIf('admin.groups.relationships.parentGroups', ['groups' => $group->parentGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="groups_courses">
            @includeIf('admin.groups.relationships.groupsCourses', ['courses' => $group->groupsCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="groups_folders">
            @includeIf('admin.groups.relationships.groupsFolders', ['folders' => $group->groupsFolders])
        </div>
    </div>
</div>

@endsection