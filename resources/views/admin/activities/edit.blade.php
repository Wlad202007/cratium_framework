@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.activity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.activities.update", [$activity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.activity.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $activity->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.activity.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Activity::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $activity->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="score">{{ trans('cruds.activity.fields.score') }}</label>
                <input class="form-control {{ $errors->has('score') ? 'is-invalid' : '' }}" type="number" name="score" id="score" value="{{ old('score', $activity->score) }}" step="1" required>
                @if($errors->has('score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.score_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="duration">{{ trans('cruds.activity.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', $activity->duration) }}" step="1">
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_start">{{ trans('cruds.activity.fields.time_start') }}</label>
                <input class="form-control datetime {{ $errors->has('time_start') ? 'is-invalid' : '' }}" type="text" name="time_start" id="time_start" value="{{ old('time_start', $activity->time_start) }}">
                @if($errors->has('time_start'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_start') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.time_start_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_end">{{ trans('cruds.activity.fields.time_end') }}</label>
                <input class="form-control datetime {{ $errors->has('time_end') ? 'is-invalid' : '' }}" type="text" name="time_end" id="time_end" value="{{ old('time_end', $activity->time_end) }}">
                @if($errors->has('time_end'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_end') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.time_end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video">{{ trans('cruds.activity.fields.video') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video') ? 'is-invalid' : '' }}" id="video-dropzone">
                </div>
                @if($errors->has('video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="files">{{ trans('cruds.activity.fields.files') }}</label>
                <div class="needsclick dropzone {{ $errors->has('files') ? 'is-invalid' : '' }}" id="files-dropzone">
                </div>
                @if($errors->has('files'))
                    <div class="invalid-feedback">
                        {{ $errors->first('files') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.files_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="test_per_page">{{ trans('cruds.activity.fields.test_per_page') }}</label>
                <input class="form-control {{ $errors->has('test_per_page') ? 'is-invalid' : '' }}" type="number" name="test_per_page" id="test_per_page" value="{{ old('test_per_page', $activity->test_per_page) }}" step="1">
                @if($errors->has('test_per_page'))
                    <div class="invalid-feedback">
                        {{ $errors->first('test_per_page') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.test_per_page_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="time_per_test">{{ trans('cruds.activity.fields.time_per_test') }}</label>
                <input class="form-control {{ $errors->has('time_per_test') ? 'is-invalid' : '' }}" type="number" name="time_per_test" id="time_per_test" value="{{ old('time_per_test', $activity->time_per_test) }}" step="1">
                @if($errors->has('time_per_test'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_per_test') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.time_per_test_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.activity.fields.mode') }}</label>
                <select class="form-control {{ $errors->has('mode') ? 'is-invalid' : '' }}" name="mode" id="mode" required>
                    <option value disabled {{ old('mode', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Activity::MODE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('mode', $activity->mode) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('mode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.activity.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $activity->description) !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="course_id">{{ trans('cruds.activity.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id">
                    @foreach($courses as $id => $course)
                        <option value="{{ $id }}" {{ (old('course_id') ? old('course_id') : $activity->course->id ?? '') == $id ? 'selected' : '' }}>{{ $course }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.course_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="checkins">{{ trans('cruds.activity.fields.checkin') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('checkins') ? 'is-invalid' : '' }}" name="checkins[]" id="checkins" multiple>
                    @foreach($checkins as $id => $checkin)
                        <option value="{{ $id }}" {{ (in_array($id, old('checkins', [])) || $activity->checkins->contains($id)) ? 'selected' : '' }}>{{ $checkin }}</option>
                    @endforeach
                </select>
                @if($errors->has('checkins'))
                    <div class="invalid-feedback">
                        {{ $errors->first('checkins') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.checkin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="moderator_id">{{ trans('cruds.activity.fields.moderator') }}</label>
                <select class="form-control select2 {{ $errors->has('moderator') ? 'is-invalid' : '' }}" name="moderator_id" id="moderator_id" required>
                    @foreach($moderators as $id => $moderator)
                        <option value="{{ $id }}" {{ (old('moderator_id') ? old('moderator_id') : $activity->moderator->id ?? '') == $id ? 'selected' : '' }}>{{ $moderator }}</option>
                    @endforeach
                </select>
                @if($errors->has('moderator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('moderator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.moderator_helper') }}</span>
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
    var uploadedVideoMap = {}
Dropzone.options.videoDropzone = {
    url: '{{ route('admin.activities.storeMedia') }}',
    maxFilesize: 2048, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2048
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="video[]" value="' + response.name + '">')
      uploadedVideoMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedVideoMap[file.name]
      }
      $('form').find('input[name="video[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($activity) && $activity->video)
          var files =
            {!! json_encode($activity->video) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="video[]" value="' + file.file_name + '">')
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
<script>
    var uploadedFilesMap = {}
Dropzone.options.filesDropzone = {
    url: '{{ route('admin.activities.storeMedia') }}',
    maxFilesize: 240, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 240
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
      uploadedFilesMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFilesMap[file.name]
      }
      $('form').find('input[name="files[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($activity) && $activity->files)
          var files =
            {!! json_encode($activity->files) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
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
                xhr.open('POST', '/admin/activities/ckmedia', true);
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
                data.append('crud_id', {{ $activity->id ?? 0 }});
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