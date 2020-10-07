<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBillRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Bill;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bill::with(['user', 'author', 'unit'])->select(sprintf('%s.*', (new Bill)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bill_show';
                $editGate      = 'bill_edit';
                $deleteGate    = 'bill_delete';
                $crudRoutePart = 'bills';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Bill::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('author_name', function ($row) {
                return $row->author ? $row->author->name : '';
            });

            $table->addColumn('unit_name', function ($row) {
                return $row->unit ? $row->unit->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'author', 'unit']);

            return $table->make(true);
        }

        $users = User::get();
        $users = User::get();
        $units = Unit::get();

        return view('admin.bills.index', compact('users', 'users', 'units'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bills.create', compact('users', 'authors', 'units'));
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());

        foreach ($request->input('scan', []) as $file) {
            $bill->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bill->id]);
        }

        return redirect()->route('admin.bills.index');
    }

    public function edit(Bill $bill)
    {
        abort_if(Gate::denies('bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $authors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill->load('user', 'author', 'unit');

        return view('admin.bills.edit', compact('users', 'authors', 'units', 'bill'));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());

        if (count($bill->scan) > 0) {
            foreach ($bill->scan as $media) {
                if (!in_array($media->file_name, $request->input('scan', []))) {
                    $media->delete();
                }
            }
        }

        $media = $bill->scan->pluck('file_name')->toArray();

        foreach ($request->input('scan', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $bill->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('scan');
            }
        }

        return redirect()->route('admin.bills.index');
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->load('user', 'author', 'unit');

        return view('admin.bills.show', compact('bill'));
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillRequest $request)
    {
        Bill::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bill_create') && Gate::denies('bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bill();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
