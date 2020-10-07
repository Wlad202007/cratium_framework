<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\Admin\AnswerResource;
use App\Models\Answer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnswersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('answer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AnswerResource(Answer::with(['user', 'variant'])->get());
    }

    public function store(StoreAnswerRequest $request)
    {
        $answer = Answer::create($request->all());

        if ($request->input('media', false)) {
            $answer->addMedia(storage_path('tmp/uploads/' . $request->input('media')))->toMediaCollection('media');
        }

        return (new AnswerResource($answer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Answer $answer)
    {
        abort_if(Gate::denies('answer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AnswerResource($answer->load(['user', 'variant']));
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

        return (new AnswerResource($answer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Answer $answer)
    {
        abort_if(Gate::denies('answer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $answer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
