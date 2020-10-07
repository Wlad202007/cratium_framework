@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.activity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.id') }}
                        </th>
                        <td>
                            {{ $activity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.name') }}
                        </th>
                        <td>
                            {{ $activity->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Activity::TYPE_SELECT[$activity->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.score') }}
                        </th>
                        <td>
                            {{ $activity->score }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.duration') }}
                        </th>
                        <td>
                            {{ $activity->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.time_start') }}
                        </th>
                        <td>
                            {{ $activity->time_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.time_end') }}
                        </th>
                        <td>
                            {{ $activity->time_end }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.video') }}
                        </th>
                        <td>
                            @foreach($activity->video as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.files') }}
                        </th>
                        <td>
                            @foreach($activity->files as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.test_per_page') }}
                        </th>
                        <td>
                            {{ $activity->test_per_page }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.time_per_test') }}
                        </th>
                        <td>
                            {{ $activity->time_per_test }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.mode') }}
                        </th>
                        <td>
                            {{ App\Models\Activity::MODE_SELECT[$activity->mode] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.description') }}
                        </th>
                        <td>
                            {!! $activity->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.course') }}
                        </th>
                        <td>
                            {{ $activity->course->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.checkin') }}
                        </th>
                        <td>
                            @foreach($activity->checkins as $key => $checkin)
                                <span class="label label-info">{{ $checkin->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.moderator') }}
                        </th>
                        <td>
                            {{ $activity->moderator->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.priority') }}
                        </th>
                        <td>
                            {{ $activity->priority }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.author') }}
                        </th>
                        <td>
                            {{ $activity->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.premise') }}
                        </th>
                        <td>
                            {{ $activity->premise->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
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
            <a class="nav-link" href="#activity_questions" role="tab" data-toggle="tab">
                {{ trans('cruds.question.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#activity_scores" role="tab" data-toggle="tab">
                {{ trans('cruds.score.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="activity_questions">
            @includeIf('admin.activities.relationships.activityQuestions', ['questions' => $activity->activityQuestions])
        </div>
        <div class="tab-pane" role="tabpanel" id="activity_scores">
            @includeIf('admin.activities.relationships.activityScores', ['scores' => $activity->activityScores])
        </div>
    </div>
</div>

@endsection