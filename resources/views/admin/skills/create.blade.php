@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.skill.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.skills.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.skill.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.skill.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cources">{{ trans('cruds.skill.fields.cources') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('cources') ? 'is-invalid' : '' }}" name="cources[]" id="cources" multiple>
                    @foreach($cources as $id => $cources)
                        <option value="{{ $id }}" {{ in_array($id, old('cources', [])) ? 'selected' : '' }}>{{ $cources }}</option>
                    @endforeach
                </select>
                @if($errors->has('cources'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cources') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.skill.fields.cources_helper') }}</span>
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