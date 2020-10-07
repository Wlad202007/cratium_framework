<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAnswerRequest;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\User;
use App\Models\Variant;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AnswersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('answer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Answer::with(['user', 'variant'])->select(sprintf('%s.*', (new Answer)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'answer_show';
                $editGate      = 'answer_edit';
                $deleteGate    = 'answer_delete';
                $crudRoutePart = 'answers';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('variant_type', function ($row) {
                return $row->variant ? $row->variant->type : '';
            });

            $table->editColumn('media', function ($row) {
                return $row->media ? '<a href="' . $row->media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'variant', 'media']);

            return $table->make(true);
        }

        $users    = User::get();
        $variants = Variant::get();

        return view('admin.answers.index', compact('users', 'variants'));
    }

    public function create()
    {
        abort_if(Gate::denies('answer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variants = Variant::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.answers.create', compact('users', 'variants'));
    }

    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->all());

        if ($request->input('media', false)) {
            $answer->addMedia(storage_path('tmp/uploads/' . $request->input('media')))->toMediaCollection('media');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $answer->id]);
        }

        return redirect()->route('admin.answers.index');
    }

    public function edit(Answer $answer)
    {
        abort_if(Gate::denies('answer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variants = Variant::all()->pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $answer->load('user', 'variant');

        return view('admin.answers.edit', compact('users', 'variants', 'answer'));
    }

    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        $answer->update($request->all());

        if ($request->input('media', false)) {
            if (!$answer->media || $request->input('media') !== $answer->media->file_name) {
                if ($answer->media) {
                    $answer->media->delete();
                }

                $answer->addMedia(storage_path('tmp/uploads/' . $request->input('media')))->toMediaCollection('media');
            }
        } elseif ($answer->media) {
            $answer->media->delete();
        }

        return redirect()->route('admin.answers.index');
    }

    public function show(Answer $answer)
    {
        abort_if(Gate::denies('answer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answer->load('user', 'variant');

        return view('admin.answers.show', compact('answer'));
    }

    public function destroy(Answer $answer)
    {
        abort_if(Gate::denies('answer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answer->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnswerRequest $request)
    {
        Answer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('answer_create') && Gate::denies('answer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Answer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
