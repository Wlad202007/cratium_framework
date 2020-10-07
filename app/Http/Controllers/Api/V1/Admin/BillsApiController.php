<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Http\Resources\Admin\BillResource;
use App\Models\Bill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillResource(Bill::with(['user', 'author', 'unit'])->get());
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());

        if ($request->input('scan', false)) {
            $bill->addMedia(storage_path('tmp/uploads/' . $request->input('scan')))->toMediaCollection('scan');
        }

        return (new BillResource($bill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillResource($bill->load(['user', 'author', 'unit']));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());

        if ($request->input('scan', false)) {
            if (!$bill->scan || $request->input('scan') !== $bill->scan->file_name) {
                if ($bill->scan) {
                    $bill->scan->delete();
                }

                $bill->addMedia(storage_path('tmp/uploads/' . $request->input('scan')))->toMediaCollection('scan');
            }
        } elseif ($bill->scan) {
            $bill->scan->delete();
        }

        return (new BillResource($bill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
