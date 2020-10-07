@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.premise.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.premises.update", [$premise->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.premise.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $premise->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.premise.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $premise->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="capacity">{{ trans('cruds.premise.fields.capacity') }}</label>
                <input class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" type="number" name="capacity" id="capacity" value="{{ old('capacity', $premise->capacity) }}" step="1">
                @if($errors->has('capacity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('capacity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.capacity_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.premise.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Premise::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $premise->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.premise.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $premise->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gps">{{ trans('cruds.premise.fields.gps') }}</label>
                <textarea class="form-control {{ $errors->has('gps') ? 'is-invalid' : '' }}" name="gps" id="gps">{{ old('gps', $premise->gps) }}</textarea>
                @if($errors->has('gps'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gps') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.premise.fields.gps_helper') }}</span>
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