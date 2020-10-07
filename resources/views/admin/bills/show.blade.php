@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bill.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.id') }}
                        </th>
                        <td>
                            {{ $bill->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.user') }}
                        </th>
                        <td>
                            {{ $bill->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.amount') }}
                        </th>
                        <td>
                            {{ $bill->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Bill::STATUS_SELECT[$bill->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.author') }}
                        </th>
                        <td>
                            {{ $bill->author->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.scan') }}
                        </th>
                        <td>
                            @foreach($bill->scan as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bill.fields.unit') }}
                        </th>
                        <td>
                            {{ $bill->unit->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bills.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection