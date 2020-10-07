<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyActivityRequest;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Course;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activities = Activity::all();

        $courses = Course::get();

        $users = User::get();

        return view('admin.activities.index', compact('activities', 'courses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $moderators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.activities.create', compact('courses', 'moderators'));
    }

    public function store(StoreActivityRequest $request)
    {
        $activity = Activity::create($request->all());

        foreach ($request->input('video', []) as $file) {
            $activity->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('video');
        }

        foreach ($request->input('files', []) as $file) {
            $activity->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $activity->id]);
        }

        return redirect()->route('admin.activities.index');
    }

    public function edit(Activity $activity)
    {
        abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checkins = User::all()->pluck('name', 'id');

        $moderators = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activity->load('course', 'checkins', 'moderator');

        return view('admin.activities.edit', compact('courses', 'checkins', 'moderators', 'activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $activity->update($request->all());
        $activity->checkins()->sync($request->input('checkins', []));

        if (count($activity->video) > 0) {
            foreach ($activity->video as $media) {
                if (!in_array($media->file_name, $request->input('video', []))) {
                    $media->delete();
                }
            }
        }

        $media = $activity->video->pluck('file_name')->toArray();

        foreach ($request->input('video', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $activity->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('video');
            }
        }

        if (count($activity->files) > 0) {
            foreach ($activity->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }

        $media = $activity->files->pluck('file_name')->toArray();

        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $activity->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.activities.index');
    }

    public function show(Activity $activity)
    {
        abort_if(Gate::denies('activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activity->load('course', 'checkins', 'moderator', 'activityQuestions');

        return view('admin.activities.show', compact('activity'));
    }

    public function destroy(Activity $activity)
    {
        abort_if(Gate::denies('activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activity->delete();

        return back();
    }

    public function massDestroy(MassDestroyActivityRequest $request)
    {
        Activity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('activity_create') && Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Activity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
