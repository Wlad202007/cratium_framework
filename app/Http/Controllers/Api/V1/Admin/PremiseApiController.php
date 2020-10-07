<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePremiseRequest;
use App\Http\Requests\UpdatePremiseRequest;
use App\Http\Resources\Admin\PremiseResource;
use App\Models\Premise;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PremiseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('premise_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PremiseResource(Premise::with(['unit', 'team'])->get());
    }

    public function store(StorePremiseRequest $request)
    {
        $premise = Premise::create($request->all());

        return (new PremiseResource($premise))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Premise $premise)
    {
        abort_if(Gate::denies('premise_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PremiseResource($premise->load(['unit', 'team']));
    }

    public function update(UpdatePremiseRequest $request, Premise $premise)
    {
        $premise->update($request->all());

        return (new PremiseResource($premise))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Premise $premise)
    {
        abort_if(Gate::denies('premise_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $premise->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
