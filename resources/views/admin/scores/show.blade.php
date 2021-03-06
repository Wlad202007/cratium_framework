@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.score.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.id') }}
                        </th>
                        <td>
                            {{ $score->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.activity') }}
                        </th>
                        <td>
                            {{ $score->activity->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.value') }}
                        </th>
                        <td>
                            {{ $score->value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.author') }}
                        </th>
                        <td>
                            {{ $score->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.score.fields.user') }}
                        </th>
                        <td>
                            {{ $score->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.scores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection