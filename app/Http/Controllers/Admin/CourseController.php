<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all();

        $users = User::get();

        $groups = Group::get();

        return view('admin.courses.index', compact('courses', 'users', 'groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        return view('admin.courses.create', compact('authors', 'groups'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        $course->authors()->sync($request->input('authors', []));
        $course->groups()->sync($request->input('groups', []));

        if ($request->input('thumbnail', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $course->id]);
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        $course->load('authors', 'groups');

        return view('admin.courses.edit', compact('authors', 'groups', 'course'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());
        $course->authors()->sync($request->input('authors', []));
        $course->groups()->sync($request->input('groups', []));

        if ($request->input('thumbnail', false)) {
            if (!$course->thumbnail || $request->input('thumbnail') !== $course->thumbnail->file_name) {
                if ($course->thumbnail) {
                    $course->thumbnail->delete();
                }

                $course->addMedia(storage_path('tmp/uploads/' . $request->input('thumbnail')))->toMediaCollection('thumbnail');
            }
        } elseif ($course->thumbnail) {
            $course->thumbnail->delete();
        }

        return redirect()->route('admin.courses.index');
    }

    public function show(Course $course)
    {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('authors', 'groups', 'courseActivities', 'courcesSkills');

        return view('admin.courses.show', compact('course'));
    }

    public function destroy(Course $course)
    {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request)
    {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('course_create') && Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Course();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
