@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.user.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.id') }}
                        </th>
                        <td>
                            {{ $user->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $user->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email_verified_at') }}
                        </th>
                        <td>
                            {{ $user->email_verified_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.verified') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.roles') }}
                        </th>
                        <td>
                            @foreach($user->roles as $key => $roles)
                                <span class="label label-info">{{ $roles->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.users.index') }}">
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
            <a class="nav-link" href="#head_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#head_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#moderator_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#user_answers" role="tab" data-toggle="tab">
                {{ trans('cruds.answer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#managers_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#authors_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.course.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#members_groups" role="tab" data-toggle="tab">
                {{ trans('cruds.group.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#checkin_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="head_units">
            @includeIf('admin.users.relationships.headUnits', ['units' => $user->headUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="head_groups">
            @includeIf('admin.users.relationships.headGroups', ['groups' => $user->headGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="moderator_activities">
            @includeIf('admin.users.relationships.moderatorActivities', ['activities' => $user->moderatorActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="user_answers">
            @includeIf('admin.users.relationships.userAnswers', ['answers' => $user->userAnswers])
        </div>
        <div class="tab-pane" role="tabpanel" id="managers_units">
            @includeIf('admin.users.relationships.managersUnits', ['units' => $user->managersUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="authors_courses">
            @includeIf('admin.users.relationships.authorsCourses', ['courses' => $user->authorsCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="members_groups">
            @includeIf('admin.users.relationships.membersGroups', ['groups' => $user->membersGroups])
        </div>
        <div class="tab-pane" role="tabpanel" id="checkin_activities">
            @includeIf('admin.users.relationships.checkinActivities', ['activities' => $user->checkinActivities])
        </div>
    </div>
</div>

@endsection