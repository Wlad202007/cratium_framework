@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.folder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.folders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.id') }}
                        </th>
                        <td>
                            {{ $folder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.name') }}
                        </th>
                        <td>
                            {{ $folder->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.color') }}
                        </th>
                        <td>
                            {{ App\Models\Folder::COLOR_SELECT[$folder->color] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.users') }}
                        </th>
                        <td>
                            @foreach($folder->users as $key => $users)
                                <span class="label label-info">{{ $users->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.groups') }}
                        </th>
                        <td>
                            @foreach($folder->groups as $key => $groups)
                                <span class="label label-info">{{ $groups->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.admin') }}
                        </th>
                        <td>
                            {{ $folder->admin->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.folder.fields.parent') }}
                        </th>
                        <td>
                            {{ $folder->parent->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.folders.index') }}">
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
            <a class="nav-link" href="#parent_folders" role="tab" data-toggle="tab">
                {{ trans('cruds.folder.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#folders_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="parent_folders">
            @includeIf('admin.folders.relationships.parentFolders', ['folders' => $folder->parentFolders])
        </div>
        <div class="tab-pane" role="tabpanel" id="folders_documents">
            @includeIf('admin.folders.relationships.foldersDocuments', ['documents' => $folder->foldersDocuments])
        </div>
    </div>
</div>

@endsection