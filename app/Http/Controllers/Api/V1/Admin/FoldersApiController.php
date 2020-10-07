<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Http\Resources\Admin\FolderResource;
use App\Models\Folder;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FoldersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('folder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FolderResource(Folder::with(['users', 'groups', 'admin'])->get());
    }

    public function store(StoreFolderRequest $request)
    {
        $folder = Folder::create($request->all());
        $folder->users()->sync($request->input('users', []));
        $folder->groups()->sync($request->input('groups', []));

        return (new FolderResource($folder))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Folder $folder)
    {
        abort_if(Gate::denies('folder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FolderResource($folder->load(['users', 'groups', 'admin']));
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $folder->update($request->all());
        $folder->users()->sync($request->input('users', []));
        $folder->groups()->sync($request->input('groups', []));

        return (new FolderResource($folder))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Folder $folder)
    {
        abort_if(Gate::denies('folder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $folder->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
