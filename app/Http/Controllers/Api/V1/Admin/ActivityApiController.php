<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Http\Resources\Admin\ActivityResource;
use App\Models\Activity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActivityResource(Activity::with(['course', 'checkins', 'moderator', 'author', 'premise'])->get());
    }

    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->all());
        $activity->checkins()->sync($request->input('checkins', []));

        if ($request->input('video', false)) {
            $activity->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
        }

        if ($request->input('files', false)) {
            $activity->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
        }

        return (new ActivityResource($activity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Activity $activity)
    {
        abort_if(Gate::denies('activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ActivityResource($activity->load(['course', 'checkins', 'moderator', 'author', 'premise']));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());
        $activity->checkins()->sync($request->input('checkins', []));

        if ($request->input('video', false)) {
            if (!$activity->video || $request->input('video') !== $activity->video->file_name) {
                if ($activity->video) {
                    $activity->video->delete();
                }

                $activity->addMedia(storage_path('tmp/uploads/' . $request->input('video')))->toMediaCollection('video');
            }
        } elseif ($activity->video) {
            $activity->video->delete();
        }

        if ($request->input('files', false)) {
            if (!$activity->files || $request->input('files') !== $activity->files->file_name) {
                if ($activity->files) {
                    $activity->files->delete();
                }

                $activity->addMedia(storage_path('tmp/uploads/' . $request->input('files')))->toMediaCollection('files');
            }
        } elseif ($activity->files) {
            $activity->files->delete();
        }

        return (new ActivityResource($activity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Activity $activity)
    {
        abort_if(Gate::denies('activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
