@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.project.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.project.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.project.fields.live') }}</label>
                @foreach(App\Models\Project::LIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('live') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="live_{{ $key }}" name="live" value="{{ $key }}" {{ old('live', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="live_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('live'))
                    <div class="invalid-feedback">
                        {{ $errors->first('live') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.live_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.project.fields.airdropcf') }}</label>
                @foreach(App\Models\Project::AIRDROPCF_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('airdropcf') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="airdropcf_{{ $key }}" name="airdropcf" value="{{ $key }}" {{ old('airdropcf', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="airdropcf_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('airdropcf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('airdropcf') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.airdropcf_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="raisefund">{{ trans('cruds.project.fields.raisefund') }}</label>
                <input class="form-control {{ $errors->has('raisefund') ? 'is-invalid' : '' }}" type="number" name="raisefund" id="raisefund" value="{{ old('raisefund', '0') }}" step="1">
                @if($errors->has('raisefund'))
                    <div class="invalid-feedback">
                        {{ $errors->first('raisefund') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.raisefund_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.project.fields.categories') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.project.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.tag_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.projects.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $project->id ?? 0 }}');
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