<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGroupRequest;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GroupsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Group::with(['unit', 'members', 'head', 'parent'])->select(sprintf('%s.*', (new Group)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'group_show';
                $editGate      = 'group_edit';
                $deleteGate    = 'group_delete';
                $crudRoutePart = 'groups';

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

            $table->editColumn('members', function ($row) {
                $labels = [];

                foreach ($row->members as $member) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $member->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('head_name', function ($row) {
                return $row->head ? $row->head->name : '';
            });

            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'unit', 'members', 'head', 'parent']);

            return $table->make(true);
        }

        $units  = Unit::get();
        $users  = User::get();
        $users  = User::get();
        $groups = Group::get();

        return view('admin.groups.index', compact('units', 'users', 'users', 'groups'));
    }

    public function create()
    {
        abort_if(Gate::denies('group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::all()->pluck('name', 'id');

        $heads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.groups.create', compact('units', 'members', 'heads', 'parents'));
    }

    public function store(StoreGroupRequest $request)
    {
        $group = Group::create($request->all());
        $group->members()->sync($request->input('members', []));

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $group->id]);
        }

        return redirect()->route('admin.groups.index');
    }

    public function edit(Group $group)
    {
        abort_if(Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $members = User::all()->pluck('name', 'id');

        $heads = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parents = Group::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $group->load('unit', 'members', 'head', 'parent');

        return view('admin.groups.edit', compact('units', 'members', 'heads', 'parents', 'group'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->all());
        $group->members()->sync($request->input('members', []));

        return redirect()->route('admin.groups.index');
    }

    public function show(Group $group)
    {
        abort_if(Gate::denies('group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->load('unit', 'members', 'head', 'parent', 'parentGroups', 'groupsCourses', 'groupsFolders');

        return view('admin.groups.show', compact('group'));
    }

    public function destroy(Group $group)
    {
        abort_if(Gate::denies('group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $group->delete();

        return back();
    }

    public function massDestroy(MassDestroyGroupRequest $request)
    {
        Group::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('group_create') && Gate::denies('group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Group();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
