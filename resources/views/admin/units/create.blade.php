@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.unit.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.unit.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Unit::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="managers">{{ trans('cruds.unit.fields.managers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('managers') ? 'is-invalid' : '' }}" name="managers[]" id="managers" multiple>
                    @foreach($managers as $id => $managers)
                        <option value="{{ $id }}" {{ in_array($id, old('managers', [])) ? 'selected' : '' }}>{{ $managers }}</option>
                    @endforeach
                </select>
                @if($errors->has('managers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('managers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.managers_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="head_id">{{ trans('cruds.unit.fields.head') }}</label>
                <select class="form-control select2 {{ $errors->has('head') ? 'is-invalid' : '' }}" name="head_id" id="head_id" required>
                    @foreach($heads as $id => $head)
                        <option value="{{ $id }}" {{ old('head_id') == $id ? 'selected' : '' }}>{{ $head }}</option>
                    @endforeach
                </select>
                @if($errors->has('head'))
                    <div class="invalid-feedback">
                        {{ $errors->first('head') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.head_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parent_id">{{ trans('cruds.unit.fields.parent') }}</label>
                <select class="form-control select2 {{ $errors->has('parent') ? 'is-invalid' : '' }}" name="parent_id" id="parent_id">
                    @foreach($parents as $id => $parent)
                        <option value="{{ $id }}" {{ old('parent_id') == $id ? 'selected' : '' }}>{{ $parent }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parent') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.parent_helper') }}</span>
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