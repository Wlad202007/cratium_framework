<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use App\Models\Folder;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DocumentsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Document::with(['unit', 'author', 'shares', 'folders'])->select(sprintf('%s.*', (new Document)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'document_show';
                $editGate      = 'document_edit';
                $deleteGate    = 'document_delete';
                $crudRoutePart = 'documents';

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
            $table->editColumn('int_number', function ($row) {
                return $row->int_number ? $row->int_number : "";
            });
            $table->editColumn('ext_number', function ($row) {
                return $row->ext_number ? $row->ext_number : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('scan', function ($row) {
                if (!$row->scan) {
                    return '';
                }

                $links = [];

                foreach ($row->scan as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->addColumn('author_name', function ($row) {
                return $row->author ? $row->author->name : '';
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? Document::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Document::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('shares', function ($row) {
                $labels = [];

                foreach ($row->shares as $share) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $share->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('folders', function ($row) {
                $labels = [];

                foreach ($row->folders as $folder) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $folder->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'scan', 'unit', 'author', 'shares', 'folders']);

            return $table->make(true);
        }

        $units   = Unit::get();
        $users   = User::get();
        $users   = User::get();
        $folders = Folder::get();

        return view('admin.documents.index', compact('units', 'users', 'users', 'folders'));
    }

    public function create()
    {
        abort_if(Gate::denies('document_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shares = User::all()->pluck('name', 'id');

        $folders = Folder::all()->pluck('name', 'id');

        return view('admin.documents.create', compact('units', 'authors', 'shares', 'folders'));
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->all());
        $document->shares()->sync($request->input('shares', []));
        $document->folders()->sync($request->input('folders', []));

        foreach ($request->input('scan', []) as $file) {
            $document->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $document->id]);
        }

        return redirect()->route('admin.documents.index');
    }

    public function edit(Document $document)
    {
        abort_if(Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shares = User::all()->pluck('name', 'id');

        $folders = Folder::all()->pluck('name', 'id');

        $document->load('unit', 'author', 'shares', 'folders');

        return view('admin.documents.edit', compact('units', 'authors', 'shares', 'folders', 'document'));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->all());
        $document->shares()->sync($request->input('shares', []));
        $document->folders()->sync($request->input('folders', []));

        if (count($document->scan) > 0) {
            foreach ($document->scan as $media) {
                if (!in_array($media->file_name, $request->input('scan', []))) {
                    $media->delete();
                }
            }
        }

        $media = $document->scan->pluck('file_name')->toArray();

        foreach ($request->input('scan', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $document->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan');
            }
        }

        return redirect()->route('admin.documents.index');
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->load('unit', 'author', 'shares', 'folders', 'documentReviews', 'documentSignatures');

        return view('admin.documents.show', compact('document'));
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return back();
    }

    public function massDestroy(MassDestroyDocumentRequest $request)
    {
        Document::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('document_create') && Gate::denies('document_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Document();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
