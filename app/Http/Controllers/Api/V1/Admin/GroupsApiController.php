<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\Admin\GroupResource;
use App\Models\Group;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GroupResource(Group::with(['unit', 'members', 'head'])->get());
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->members()->sync($request->input('members', []));

        return (new GroupResource($group))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GroupResource($group->load(['unit', 'members', 'head']));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->members()->sync($request->input('members', []));

        return (new GroupResource($group))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
