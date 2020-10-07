<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Http\Resources\Admin\DocumentResource;
use App\Models\Document;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('document_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource(Document::with(['unit', 'author', 'shares', 'folders'])->get());
    }

    public function store(StoreDocumentRequest $request)
    {
        $document = Document::create($request->all());
        $document->shares()->sync($request->input('shares', []));
        $document->folders()->sync($request->input('folders', []));

        if ($request->input('scan', false)) {
            $document->addMedia(storage_path('tmp/uploads/' . $request->input('scan')))->toMediaCollection('scan');
        }

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Document $document)
    {
        abort_if(Gate::denies('document_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DocumentResource($document->load(['unit', 'author', 'shares', 'folders']));
    }

    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->all());
        $document->shares()->sync($request->input('shares', []));
        $document->folders()->sync($request->input('folders', []));

        if ($request->input('scan', false)) {
            if (!$document->scan || $request->input('scan') !== $document->scan->file_name) {
                if ($document->scan) {
                    $document->scan->delete();
                }

                $document->addMedia(storage_path('tmp/uploads/' . $request->input('scan')))->toMediaCollection('scan');
            }
        } elseif ($document->scan) {
            $document->scan->delete();
        }

        return (new DocumentResource($document))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Document $document)
    {
        abort_if(Gate::denies('document_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $document->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
