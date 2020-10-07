@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.publication.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.publications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.id') }}
                        </th>
                        <td>
                            {{ $publication->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.title') }}
                        </th>
                        <td>
                            {{ $publication->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.date') }}
                        </th>
                        <td>
                            {{ $publication->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.edition') }}
                        </th>
                        <td>
                            {{ App\Models\Publication::EDITION_SELECT[$publication->edition] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.database') }}
                        </th>
                        <td>
                            {{ App\Models\Publication::DATABASE_SELECT[$publication->database] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.url') }}
                        </th>
                        <td>
                            {{ $publication->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.document') }}
                        </th>
                        <td>
                            @if($publication->document)
                                <a href="{{ $publication->document->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.author') }}
                        </th>
                        <td>
                            {{ $publication->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.edition_number') }}
                        </th>
                        <td>
                            {{ $publication->edition_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.pages_count') }}
                        </th>
                        <td>
                            {{ $publication->pages_count }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.location') }}
                        </th>
                        <td>
                            {{ $publication->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Publication::TYPE_SELECT[$publication->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.publication.fields.coauthors') }}
                        </th>
                        <td>
                            {{ $publication->coauthors }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.publications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection