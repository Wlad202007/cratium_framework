<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Resources\Admin\PublicationResource;
use App\Models\Publication;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicationsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('publication_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PublicationResource(Publication::with(['author'])->get());
    }

    public function store(StorePublicationRequest $request)
    {
        $publication = Publication::create($request->all());

        if ($request->input('document', false)) {
            $publication->addMedia(storage_path('tmp/uploads/' . $request->input('document')))->toMediaCollection('document');
        }

        return (new PublicationResource($publication))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Publication $publication)
    {
        abort_if(Gate::denies('publication_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PublicationResource($publication->load(['author']));
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

        return (new PublicationResource($publication))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Publication $publication)
    {
        abort_if(Gate::denies('publication_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publication->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
