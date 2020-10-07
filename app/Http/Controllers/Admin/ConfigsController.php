<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConfigRequest;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ConfigsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Config::with(['parent'])->select(sprintf('%s.*', (new Config)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'config_show';
                $editGate      = 'config_edit';
                $deleteGate    = 'config_delete';
                $crudRoutePart = 'configs';

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
            $table->editColumn('term', function ($row) {
                return $row->term ? $row->term : "";
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : "";
            });
            $table->addColumn('parent_term', function ($row) {
                return $row->parent ? $row->parent->term : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'parent']);

            return $table->make(true);
        }

        $configs = Config::get();

        return view('admin.configs.index', compact('configs'));
    }

    public function create()
    {
        abort_if(Gate::denies('config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Config::all()->pluck('term', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.configs.create', compact('parents'));
    }

    public function store(StoreConfigRequest $request)
    {
        $config = Config::create($request->all());

        return redirect()->route('admin.configs.index');
    }

    public function edit(Config $config)
    {
        abort_if(Gate::denies('config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parents = Config::all()->pluck('term', 'id')->prepend(trans('global.pleaseSelect'), '');

        $config->load('parent');

        return view('admin.configs.edit', compact('parents', 'config'));
    }

    public function update(UpdateConfigRequest $request, Config $config)
    {
        $config->update($request->all());

        return redirect()->route('admin.configs.index');
    }

    public function show(Config $config)
    {
        abort_if(Gate::denies('config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config->load('parent', 'parentConfigs');

        return view('admin.configs.show', compact('config'));
    }

    public function destroy(Config $config)
    {
        abort_if(Gate::denies('config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $config->delete();

        return back();
    }

    public function massDestroy(MassDestroyConfigRequest $request)
    {
        Config::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
