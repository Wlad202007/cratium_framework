@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.publication.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.publications.update", [$publication->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.publication.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $publication->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.publication.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $publication->date) }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.publication.fields.edition') }}</label>
                <select class="form-control {{ $errors->has('edition') ? 'is-invalid' : '' }}" name="edition" id="edition" required>
                    <option value disabled {{ old('edition', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Publication::EDITION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('edition', $publication->edition) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('edition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('edition') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.edition_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.publication.fields.database') }}</label>
                <select class="form-control {{ $errors->has('database') ? 'is-invalid' : '' }}" name="database" id="database">
                    <option value disabled {{ old('database', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Publication::DATABASE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('database', $publication->database) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('database'))
                    <div class="invalid-feedback">
                        {{ $errors->first('database') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.database_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="url">{{ trans('cruds.publication.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $publication->url) }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="document">{{ trans('cruds.publication.fields.document') }}</label>
                <div class="needsclick dropzone {{ $errors->has('document') ? 'is-invalid' : '' }}" id="document-dropzone">
                </div>
                @if($errors->has('document'))
                    <div class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.document_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="author_id">{{ trans('cruds.publication.fields.author') }}</label>
                <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" required>
                    @foreach($authors as $id => $author)
                        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $publication->author->id ?? '') == $id ? 'selected' : '' }}>{{ $author }}</option>
                    @endforeach
                </select>
                @if($errors->has('author'))
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.author_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="edition_number">{{ trans('cruds.publication.fields.edition_number') }}</label>
                <input class="form-control {{ $errors->has('edition_number') ? 'is-invalid' : '' }}" type="text" name="edition_number" id="edition_number" value="{{ old('edition_number', $publication->edition_number) }}">
                @if($errors->has('edition_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('edition_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.edition_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pages_count">{{ trans('cruds.publication.fields.pages_count') }}</label>
                <input class="form-control {{ $errors->has('pages_count') ? 'is-invalid' : '' }}" type="number" name="pages_count" id="pages_count" value="{{ old('pages_count', $publication->pages_count) }}" step="1">
                @if($errors->has('pages_count'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pages_count') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.pages_count_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.publication.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $publication->location) }}">
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.publication.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Publication::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $publication->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="coauthors">{{ trans('cruds.publication.fields.coauthors') }}</label>
                <textarea class="form-control {{ $errors->has('coauthors') ? 'is-invalid' : '' }}" name="coauthors" id="coauthors">{{ old('coauthors', $publication->coauthors) }}</textarea>
                @if($errors->has('coauthors'))
                    <div class="invalid-feedback">
                        {{ $errors->first('coauthors') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.publication.fields.coauthors_helper') }}</span>
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
    Dropzone.options.documentDropzone = {
    url: '{{ route('admin.publications.storeMedia') }}',
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
      $('form').find('input[name="document"]').remove()
      $('form').append('<input type="hidden" name="document" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="document"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($publication) && $publication->document)
      var file = {!! json_encode($publication->document) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="document" value="' + file.file_name + '">')
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
@endsection