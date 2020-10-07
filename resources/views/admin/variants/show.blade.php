@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.variant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.variants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.variant.fields.id') }}
                        </th>
                        <td>
                            {{ $variant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variant.fields.question') }}
                        </th>
                        <td>
                            {{ $variant->question->question ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variant.fields.answer') }}
                        </th>
                        <td>
                            {!! $variant->answer !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variant.fields.image') }}
                        </th>
                        <td>
                            @if($variant->image)
                                <a href="{{ $variant->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $variant->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.variant.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Variant::TYPE_SELECT[$variant->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.variants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#variant_answers" role="tab" data-toggle="tab">
                {{ trans('cruds.answer.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="variant_answers">
            @includeIf('admin.variants.relationships.variantAnswers', ['answers' => $variant->variantAnswers])
        </div>
    </div>
</div>

@endsection