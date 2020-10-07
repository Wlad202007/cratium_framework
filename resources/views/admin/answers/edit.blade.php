@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.answer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.answers.update", [$answer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.answer.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $answer->user->id ?? '') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="variant_id">{{ trans('cruds.answer.fields.variant') }}</label>
                <select class="form-control select2 {{ $errors->has('variant') ? 'is-invalid' : '' }}" name="variant_id" id="variant_id" required>
                    @foreach($variants as $id => $variant)
                        <option value="{{ $id }}" {{ (old('variant_id') ? old('variant_id') : $answer->variant->id ?? '') == $id ? 'selected' : '' }}>{{ $variant }}</option>
                    @endforeach
                </select>
                @if($errors->has('variant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('variant') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.variant_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="media">{{ trans('cruds.answer.fields.media') }}</label>
                <div class="needsclick dropzone {{ $errors->has('media') ? 'is-invalid' : '' }}" id="media-dropzone">
                </div>
                @if($errors->has('media'))
                    <div class="invalid-feedback">
                        {{ $errors->first('media') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.media_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long_answer">{{ trans('cruds.answer.fields.long_answer') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_answer') ? 'is-invalid' : '' }}" name="long_answer" id="long_answer">{!! old('long_answer', $answer->long_answer) !!}</textarea>
                @if($errors->has('long_answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long_answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.answer.fields.long_answer_helper') }}</span>
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
    Dropzone.options.mediaDropzone = {
    url: '{{ route('admin.answers.storeMedia') }}',
    maxFilesize: 120, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 120
    },
    success: function (file, response) {
      $('form').find('input[name="media"]').remove()
      $('form').append('<input type="hidden" name="media" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="media"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($answer) && $answer->media)
      var file = {!! json_encode($answer->media) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="media" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
                xhr.open('POST', '/admin/answers/ckmedia', true);
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
                data.append('crud_id', {{ $answer->id ?? 0 }});
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