<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScoreRequest;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use App\Models\Activity;
use App\Models\Score;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ScoresController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('score_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Score::with(['author', 'user', 'activity'])->select(sprintf('%s.*', (new Score)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'score_show';
                $editGate      = 'score_edit';
                $deleteGate    = 'score_delete';
                $crudRoutePart = 'scores';

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
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : "";
            });
            $table->addColumn('author_name', function ($row) {
                return $row->author ? $row->author->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('activity_name', function ($row) {
                return $row->activity ? $row->activity->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'author', 'user', 'activity']);

            return $table->make(true);
        }

        $users      = User::get();
        $users      = User::get();
        $activities = Activity::get();

        return view('admin.scores.index', compact('users', 'users', 'activities'));
    }

    public function create()
    {
        abort_if(Gate::denies('score_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activities = Activity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.scores.create', compact('authors', 'users', 'activities'));
    }

    public function store(StoreScoreRequest $request)
    {
        $score = Score::create($request->all());

        return redirect()->route('admin.scores.index');
    }

    public function edit(Score $score)
    {
        abort_if(Gate::denies('score_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $activities = Activity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $score->load('author', 'user', 'activity');

        return view('admin.scores.edit', compact('authors', 'users', 'activities', 'score'));
    }

    public function update(UpdateScoreRequest $request, Score $score)
    {
        $score->update($request->all());

        return redirect()->route('admin.scores.index');
    }

    public function show(Score $score)
    {
        abort_if(Gate::denies('score_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $score->load('author', 'user', 'activity');

        return view('admin.scores.show', compact('score'));
    }

    public function destroy(Score $score)
    {
        abort_if(Gate::denies('score_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $score->delete();

        return back();
    }

    public function massDestroy(MassDestroyScoreRequest $request)
    {
        Score::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
