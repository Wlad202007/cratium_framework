<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFolderRequest;
use App\Http\Requests\StoreFolderRequest;
use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use App\Models\Group;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FoldersController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('folder_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Folder::with(['users', 'groups', 'parent', 'admin'])->select(sprintf('%s.*', (new Folder)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'folder_show';
                $editGate      = 'folder_edit';
                $deleteGate    = 'folder_delete';
                $crudRoutePart = 'folders';

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
            $table->editColumn('color', function ($row) {
                return $row->color ? Folder::COLOR_SELECT[$row->color] : '';
            });
            $table->editColumn('users', function ($row) {
                $labels = [];

                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('groups', function ($row) {
                $labels = [];

                foreach ($row->groups as $group) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $group->name);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('parent_name', function ($row) {
                return $row->parent ? $row->parent->name : '';
            });

            $table->addColumn('admin_name', function ($row) {
                return $row->admin ? $row->admin->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'users', 'groups', 'parent', 'admin']);

            return $table->make(true);
        }

        $users   = User::get();
        $groups  = Group::get();
        $folders = Folder::get();
        $users   = User::get();

        return view('admin.folders.index', compact('users', 'groups', 'folders', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('folder_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        $parents = Folder::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.folders.create', compact('users', 'groups', 'parents', 'admins'));
    }

    public function store(StoreFolderRequest $request)
    {
        $folder = Folder::create($request->all());
        $folder->users()->sync($request->input('users', []));
        $folder->groups()->sync($request->input('groups', []));

        return redirect()->route('admin.folders.index');
    }

    public function edit(Folder $folder)
    {
        abort_if(Gate::denies('folder_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        $groups = Group::all()->pluck('name', 'id');

        $parents = Folder::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $folder->load('users', 'groups', 'parent', 'admin');

        return view('admin.folders.edit', compact('users', 'groups', 'parents', 'admins', 'folder'));
    }

    public function update(UpdateFolderRequest $request, Folder $folder)
    {
        $folder->update($request->all());
        $folder->users()->sync($request->input('users', []));
        $folder->groups()->sync($request->input('groups', []));

        return redirect()->route('admin.folders.index');
    }

    public function show(Folder $folder)
    {
        abort_if(Gate::denies('folder_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $folder->load('users', 'groups', 'parent', 'admin', 'parentFolders', 'foldersDocuments');

        return view('admin.folders.show', compact('folder'));
    }

    public function destroy(Folder $folder)
    {
        abort_if(Gate::denies('folder_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $folder->delete();

        return back();
    }

    public function massDestroy(MassDestroyFolderRequest $request)
    {
        Folder::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
