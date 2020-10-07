<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySignatureRequest;
use App\Http\Requests\StoreSignatureRequest;
use App\Http\Requests\UpdateSignatureRequest;
use App\Models\Document;
use App\Models\Signature;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SignatureController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('signature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Signature::with(['user', 'document'])->select(sprintf('%s.*', (new Signature)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'signature_show';
                $editGate      = 'signature_edit';
                $deleteGate    = 'signature_delete';
                $crudRoutePart = 'signatures';

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

            $table->addColumn('document_int_number', function ($row) {
                return $row->document ? $row->document->int_number : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Signature::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'document']);

            return $table->make(true);
        }

        $users     = User::get();
        $documents = Document::get();

        return view('admin.signatures.index', compact('users', 'documents'));
    }

    public function create()
    {
        abort_if(Gate::denies('signature_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documents = Document::all()->pluck('int_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.signatures.create', compact('users', 'documents'));
    }

    public function store(StoreSignatureRequest $request)
    {
        $signature = Signature::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $signature->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $signature->id]);
        }

        return redirect()->route('admin.signatures.index');
    }

    public function edit(Signature $signature)
    {
        abort_if(Gate::denies('signature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $documents = Document::all()->pluck('int_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $signature->load('user', 'document');

        return view('admin.signatures.edit', compact('users', 'documents', 'signature'));
    }

    public function update(UpdateSignatureRequest $request, Signature $signature)
    {
        $signature->update($request->all());

        if (count($signature->file) > 0) {
            foreach ($signature->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }

        $media = $signature->file->pluck('file_name')->toArray();

        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $signature->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.signatures.index');
    }

    public function show(Signature $signature)
    {
        abort_if(Gate::denies('signature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signature->load('user', 'document');

        return view('admin.signatures.show', compact('signature'));
    }

    public function destroy(Signature $signature)
    {
        abort_if(Gate::denies('signature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signature->delete();

        return back();
    }

    public function massDestroy(MassDestroySignatureRequest $request)
    {
        Signature::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('signature_create') && Gate::denies('signature_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Signature();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
