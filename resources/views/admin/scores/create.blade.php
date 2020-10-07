@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.score.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.scores.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.score.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', '0') }}" step="1" required>
                @if($errors->has('value'))
                    <div class="invalid-feedback">
                        {{ $errors->first('value') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="model">{{ trans('cruds.score.fields.model') }}</label>
                <input class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}" type="number" name="model" id="model" value="{{ old('model', '') }}" step="1">
                @if($errors->has('model'))
                    <div class="invalid-feedback">
                        {{ $errors->first('model') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.model_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="model_type">{{ trans('cruds.score.fields.model_type') }}</label>
                <input class="form-control {{ $errors->has('model_type') ? 'is-invalid' : '' }}" type="text" name="model_type" id="model_type" value="{{ old('model_type', '') }}">
                @if($errors->has('model_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('model_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.model_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.score.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ old('author_id') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.score.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.score.fields.user_helper') }}</span>
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