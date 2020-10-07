@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.config.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.configs.update", [$config->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="term">{{ trans('cruds.config.fields.term') }}</label>
                <input class="form-control {{ $errors->has('term') ? 'is-invalid' : '' }}" type="text" name="term" id="term" value="{{ old('term', $config->term) }}" required>
                @if($errors->has('term'))
                    <div class="invalid-feedback">
                        {{ $errors->first('term') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.config.fields.term_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.config.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="text" name="value" id="value" value="{{ old('value', $config->value) }}" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.config.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_id">{{ trans('cruds.config.fields.parent') }}</label>
                <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                    @foreach($parents as $id => $parent)
                        <option value="{{ $id }}" {{ (old('parent_id') ? old('parent_id') : $config->parent->id ?? '') == $id ? 'selected' : '' }}>{{ $parent }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.config.fields.parent_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection