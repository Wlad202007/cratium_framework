<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUnitRequest;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Unit::with(['managers', 'head', 'parent'])->select(sprintf('%s.*', (new Unit)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'unit_show';
                $editGate      = 'unit_edit';
                $deleteGate    = 'unit_delete';
                $crudRoutePart = 'units';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Unit::TYPE_SELECT[$row->type] : '';
            });
            $table->addColumn('head_name', function ($row) {
                return $row->head ? $row->head->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'head']);

            return $table->make(true);
        }

        $users = User::get();
        $users = User::get();
        $units = Unit::get();

        return view('admin.units.index', compact('users', 'users', 'units'));
    }

    public function create()
    {
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::all()->pluck('name', 'id');

        $heads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.units.create', compact('managers', 'heads', 'parents'));
    }

    public function store(StoreUnitRequest $request)
    {
        $unit = Unit::create($request->all());
        $unit->managers()->sync($request->input('managers', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $unit->id]);
        }

        return redirect()->route('admin.units.index');
    }

    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managers = User::all()->pluck('name', 'id');

        $heads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unit->load('managers', 'head', 'parent');

        return view('admin.units.edit', compact('managers', 'heads', 'parents', 'unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        $unit->managers()->sync($request->input('managers', []));

        return redirect()->route('admin.units.index');
    }

    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->load('managers', 'head', 'parent', 'unitPremises', 'unitGroups', 'unitDocuments', 'parentUnits', 'unitBills', 'unitsTemplates');

        return view('admin.units.show', compact('unit'));
    }

    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unit->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitRequest $request)
    {
        Unit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('unit_create') && Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Unit();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
