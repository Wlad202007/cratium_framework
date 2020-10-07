<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVariantRequest;
use App\Http\Requests\StoreVariantRequest;
use App\Http\Requests\UpdateVariantRequest;
use App\Models\Question;
use App\Models\Variant;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VariantsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('variant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Variant::with(['question'])->select(sprintf('%s.*', (new Variant)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'variant_show';
                $editGate      = 'variant_edit';
                $deleteGate    = 'variant_delete';
                $crudRoutePart = 'variants';

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
            $table->addColumn('question_question', function ($row) {
                return $row->question ? $row->question->question : '';
            });

            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Variant::TYPE_SELECT[$row->type] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'question', 'image']);

            return $table->make(true);
        }

        return view('admin.variants.index');
    }

    public function create()
    {
        abort_if(Gate::denies('variant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.variants.create', compact('questions'));
    }

    public function store(StoreVariantRequest $request)
    {
        $variant = Variant::create($request->all());

        if ($request->input('image', false)) {
            $variant->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $variant->id]);
        }

        return redirect()->route('admin.variants.index');
    }

    public function edit(Variant $variant)
    {
        abort_if(Gate::denies('variant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        $variant->load('question');

        return view('admin.variants.edit', compact('questions', 'variant'));
    }

    public function update(UpdateVariantRequest $request, Variant $variant)
    {
        $variant->update($request->all());

        if ($request->input('image', false)) {
            if (!$variant->image || $request->input('image') !== $variant->image->file_name) {
                if ($variant->image) {
                    $variant->image->delete();
                }

                $variant->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($variant->image) {
            $variant->image->delete();
        }

        return redirect()->route('admin.variants.index');
    }

    public function show(Variant $variant)
    {
        abort_if(Gate::denies('variant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variant->load('question', 'variantAnswers');

        return view('admin.variants.show', compact('variant'));
    }

    public function destroy(Variant $variant)
    {
        abort_if(Gate::denies('variant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variant->delete();

        return back();
    }

    public function massDestroy(MassDestroyVariantRequest $request)
    {
        Variant::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('variant_create') && Gate::denies('variant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Variant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
