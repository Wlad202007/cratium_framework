@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.document.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.documents.update", [$document->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="int_number">{{ trans('cruds.document.fields.int_number') }}</label>
                <input class="form-control {{ $errors->has('int_number') ? 'is-invalid' : '' }}" type="text" name="int_number" id="int_number" value="{{ old('int_number', $document->int_number) }}">
                @if($errors->has('int_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('int_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.int_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ext_number">{{ trans('cruds.document.fields.ext_number') }}</label>
                <input class="form-control {{ $errors->has('ext_number') ? 'is-invalid' : '' }}" type="text" name="ext_number" id="ext_number" value="{{ old('ext_number', $document->ext_number) }}">
                @if($errors->has('ext_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ext_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.ext_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.document.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $document->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="body">{{ trans('cruds.document.fields.body') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body">{!! old('body', $document->body) !!}</textarea>
                @if($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.body_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="scan">{{ trans('cruds.document.fields.scan') }}</label>
                <div class="needsclick dropzone {{ $errors->has('scan') ? 'is-invalid' : '' }}" id="scan-dropzone">
                </div>
                @if($errors->has('scan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('scan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.scan_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_id">{{ trans('cruds.document.fields.unit') }}</label>
                <select class="form-control select2 {{ $errors->has('unit') ? 'is-invalid' : '' }}" name="unit_id" id="unit_id" required>
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ (old('unit_id') ? old('unit_id') : $document->unit->id ?? '') == $id ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.document.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $document->author->id ?? '') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.document.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Document::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $document->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.document.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Document::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $document->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shares">{{ trans('cruds.document.fields.shares') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('shares') ? 'is-invalid' : '' }}" name="shares[]" id="shares" multiple>
                    @foreach($shares as $id => $shares)
                        <option value="{{ $id }}" {{ (in_array($id, old('shares', [])) || $document->shares->contains($id)) ? 'selected' : '' }}>{{ $shares }}</option>
                    @endforeach
                </select>
                @if($errors->has('shares'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shares') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.shares_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="folders">{{ trans('cruds.document.fields.folders') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('folders') ? 'is-invalid' : '' }}" name="folders[]" id="folders" multiple>
                    @foreach($folders as $id => $folders)
                        <option value="{{ $id }}" {{ (in_array($id, old('folders', [])) || $document->folders->contains($id)) ? 'selected' : '' }}>{{ $folders }}</option>
                    @endforeach
                </select>
                @if($errors->has('folders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('folders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.document.fields.folders_helper') }}</span>
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
                xhr.open('POST', '/admin/documents/ckmedia', true);
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
                data.append('crud_id', {{ $document->id ?? 0 }});
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

<script>
    var uploadedScanMap = {}
Dropzone.options.scanDropzone = {
    url: '{{ route('admin.documents.storeMedia') }}',
    maxFilesize: 1024, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1024
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="scan[]" value="' + response.name + '">')
      uploadedScanMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedScanMap[file.name]
      }
      $('form').find('input[name="scan[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($document) && $document->scan)
          var files =
            {!! json_encode($document->scan) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="scan[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection