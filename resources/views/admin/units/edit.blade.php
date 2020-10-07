@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.unit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.units.update", [$unit->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.unit.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $unit->name) }}" required>
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
                        <option value="{{ $key }}" {{ old('type', $unit->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                        <option value="{{ $id }}" {{ (in_array($id, old('managers', [])) || $unit->managers->contains($id)) ? 'selected' : '' }}>{{ $managers }}</option>
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
                        <option value="{{ $id }}" {{ (old('head_id') ? old('head_id') : $unit->head->id ?? '') == $id ? 'selected' : '' }}>{{ $head }}</option>
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
                        <option value="{{ $id }}" {{ (old('parent_id') ? old('parent_id') : $unit->parent->id ?? '') == $id ? 'selected' : '' }}>{{ $parent }}</option>
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
                <label for="financial_details">{{ trans('cruds.unit.fields.financial_details') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('financial_details') ? 'is-invalid' : '' }}" name="financial_details" id="financial_details">{!! old('financial_details', $unit->financial_details) !!}</textarea>
                @if($errors->has('financial_details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('financial_details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.unit.fields.financial_details_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/units/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $unit->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection