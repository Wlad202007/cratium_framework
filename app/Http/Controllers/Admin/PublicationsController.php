<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPublicationRequest;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Publication;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PublicationsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('publication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Publication::with(['author'])->select(sprintf('%s.*', (new Publication)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'publication_show';
                $editGate      = 'publication_edit';
                $deleteGate    = 'publication_delete';
                $crudRoutePart = 'publications';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });

            $table->editColumn('edition', function ($row) {
                return $row->edition ? Publication::EDITION_SELECT[$row->edition] : '';
            });
            $table->editColumn('database', function ($row) {
                return $row->database ? Publication::DATABASE_SELECT[$row->database] : '';
            });
            $table->editColumn('document', function ($row) {
                return $row->document ? '<a href="' . $row->document->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('author_name', function ($row) {
                return $row->author ? $row->author->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Publication::TYPE_SELECT[$row->type] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'document', 'author']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.publications.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('publication_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.publications.create', compact('authors'));
    }

    public function store(StorePublicationRequest $request)
    {
        $publication = Publication::create($request->all());

        if ($request->input('document', false)) {
            $publication->addMedia(storage_path('tmp/uploads/' . $request->input('document')))->toMediaCollection('document');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $publication->id]);
        }

        return redirect()->route('admin.publications.index');
    }

    public function edit(Publication $publication)
    {
        abort_if(Gate::denies('publication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publication->load('author');

        return view('admin.publications.edit', compact('authors', 'publication'));
    }

    public function update(UpdatePublicationRequest $request, Publication $publication)
    {
        $publication->update($request->all());

        if ($request->input('document', false)) {
            if (!$publication->document || $request->input('document') !== $publication->document->file_name) {
                if ($publication->document) {
                    $publication->document->delete();
                }

                $publication->addMedia(storage_path('tmp/uploads/' . $request->input('document')))->toMediaCollection('document');
            }
        } elseif ($publication->document) {
            $publication->document->delete();
        }

        return redirect()->route('admin.publications.index');
    }

    public function show(Publication $publication)
    {
        abort_if(Gate::denies('publication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publication->load('author');

        return view('admin.publications.show', compact('publication'));
    }

    public function destroy(Publication $publication)
    {
        abort_if(Gate::denies('publication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publication->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublicationRequest $request)
    {
        Publication::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('publication_create') && Gate::denies('publication_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Publication();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
