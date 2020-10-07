@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.document.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.id') }}
                        </th>
                        <td>
                            {{ $document->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.int_number') }}
                        </th>
                        <td>
                            {{ $document->int_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.ext_number') }}
                        </th>
                        <td>
                            {{ $document->ext_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.title') }}
                        </th>
                        <td>
                            {{ $document->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.body') }}
                        </th>
                        <td>
                            {!! $document->body !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.scan') }}
                        </th>
                        <td>
                            @foreach($document->scan as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.unit') }}
                        </th>
                        <td>
                            {{ $document->unit->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.author') }}
                        </th>
                        <td>
                            {{ $document->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Document::TYPE_SELECT[$document->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Document::STATUS_SELECT[$document->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.shares') }}
                        </th>
                        <td>
                            @foreach($document->shares as $key => $shares)
                                <span class="label label-info">{{ $shares->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.document.fields.folders') }}
                        </th>
                        <td>
                            @foreach($document->folders as $key => $folders)
                                <span class="label label-info">{{ $folders->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.documents.index') }}">
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
            <a class="nav-link" href="#document_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.review.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#document_signatures" role="tab" data-toggle="tab">
                {{ trans('cruds.signature.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="document_reviews">
            @includeIf('admin.documents.relationships.documentReviews', ['reviews' => $document->documentReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="document_signatures">
            @includeIf('admin.documents.relationships.documentSignatures', ['signatures' => $document->documentSignatures])
        </div>
    </div>
</div>

@endsection