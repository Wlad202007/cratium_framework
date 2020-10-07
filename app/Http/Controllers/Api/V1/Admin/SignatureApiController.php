<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSignatureRequest;
use App\Http\Requests\UpdateSignatureRequest;
use App\Http\Resources\Admin\SignatureResource;
use App\Models\Signature;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SignatureApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('signature_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SignatureResource(Signature::with(['user', 'document'])->get());
    }

    public function store(StoreSignatureRequest $request)
    {
        $signature = Signature::create($request->all());

        if ($request->input('file', false)) {
            $signature->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
        }

        return (new SignatureResource($signature))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Signature $signature)
    {
        abort_if(Gate::denies('signature_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SignatureResource($signature->load(['user', 'document']));
    }

    public function update(UpdateSignatureRequest $request, Signature $signature)
    {
        $signature->update($request->all());

        if ($request->input('file', false)) {
            if (!$signature->file || $request->input('file') !== $signature->file->file_name) {
                if ($signature->file) {
                    $signature->file->delete();
                }

                $signature->addMedia(storage_path('tmp/uploads/' . $request->input('file')))->toMediaCollection('file');
            }
        } elseif ($signature->file) {
            $signature->file->delete();
        }

        return (new SignatureResource($signature))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Signature $signature)
    {
        abort_if(Gate::denies('signature_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signature->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
