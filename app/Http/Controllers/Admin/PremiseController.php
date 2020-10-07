<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPremiseRequest;
use App\Http\Requests\StorePremiseRequest;
use App\Http\Requests\UpdatePremiseRequest;
use App\Models\Premise;
use App\Models\Team;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PremiseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('premise_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Premise::with(['unit', 'parent', 'team'])->select(sprintf('%s.*', (new Premise)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'premise_show';
                $editGate      = 'premise_edit';
                $deleteGate    = 'premise_delete';
                $crudRoutePart = 'premises';

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
            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : "";
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Premise::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : "";
            });
            $table->editColumn('gps', function ($row) {
                return $row->gps ? $row->gps : "";
            });
            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'parent']);

            return $table->make(true);
        }

        $units    = Unit::get();
        $premises = Premise::get();
        $teams    = Team::get();

        return view('admin.premises.index', compact('units', 'premises', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('premise_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Premise::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.premises.create', compact('units', 'parents'));
    }

    public function store(StorePremiseRequest $request)
    {
        $premise = Premise::create($request->all());

        return redirect()->route('admin.premises.index');
    }

    public function edit(Premise $premise)
    {
        abort_if(Gate::denies('premise_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Premise::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $premise->load('unit', 'parent', 'team');

        return view('admin.premises.edit', compact('units', 'parents', 'premise'));
    }

    public function update(UpdatePremiseRequest $request, Premise $premise)
    {
        $premise->update($request->all());

        return redirect()->route('admin.premises.index');
    }

    public function show(Premise $premise)
    {
        abort_if(Gate::denies('premise_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $premise->load('unit', 'parent', 'team', 'parentPremises');

        return view('admin.premises.show', compact('premise'));
    }

    public function destroy(Premise $premise)
    {
        abort_if(Gate::denies('premise_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $premise->delete();

        return back();
    }

    public function massDestroy(MassDestroyPremiseRequest $request)
    {
        Premise::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
