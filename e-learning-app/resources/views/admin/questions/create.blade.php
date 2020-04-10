@extends('layouts.admin')
@section('content')
    <div style="margin: 20px;">
        <h4>
            Ajouter une question </h4>
        <div style="border: solid 1px grey; padding: 20px;">
                    <form method="POST" action="{{ route("admin.questions.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="{{ $errors->has('texte') ? 'has-error' : '' }}">
                            <label class="required" for="texte">Texte de la question</label>
                            <textarea style="width: 100%; padding: 4px;" name="texte" id="texte" required>{{ old('texte') }}</textarea>
                            @if($errors->has('texte'))
                                <span class="help-block" role="alert">{{ $errors->first('texte') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('score') ? 'has-error' : '' }}">
                            <label for="score">Score</label>
                            <input style="width: 100%; padding: 4px;" type="number" name="score" id="score" value="{{ old('score') }}" step="1">
                            @if($errors->has('score'))
                                <span class="help-block" role="alert">{{ $errors->first('score') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image">Image</label>
                            <div class="needsclick dropzone" id="image-dropzone">
                            </div>
                            @if($errors->has('image'))
                                <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('option_1') ? 'has-error' : '' }}">
                            <label class="required" for="option_1">Option 1</label>
                            <input style="width: 100%; padding: 4px;" type="text" name="option_1" id="option_1" value="{{ old('option_1', '') }}" required>
                            @if($errors->has('option_1'))
                                <span class="help-block" role="alert">{{ $errors->first('option_1') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('correct_1') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="correct_1" value="0">
                                <input type="checkbox" name="correct_1" id="correct_1" value="1" {{ old('correct_1', 0) == 1 ? 'checked' : '' }}>
                                <label for="correct_1" style="font-weight: 400">Correct 1</label>
                            </div>
                            @if($errors->has('correct_1'))
                                <span class="help-block" role="alert">{{ $errors->first('correct_1') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('option_2') ? 'has-error' : '' }}">
                            <label class="required" for="option_2">Option 2</label>
                            <input style="width: 100%; padding: 4px;" type="text" name="option_2" id="option_2" value="{{ old('option_2', '') }}" required>
                            @if($errors->has('option_2'))
                                <span class="help-block" role="alert">{{ $errors->first('option_2') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('correct_2') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="correct_2" value="0">
                                <input type="checkbox" name="correct_2" id="correct_2" value="1" {{ old('correct_2', 0) == 1 ? 'checked' : '' }}>
                                <label for="correct_2" style="font-weight: 400">Correct 2</label>
                            </div>
                            @if($errors->has('correct_2'))
                                <span class="help-block" role="alert">{{ $errors->first('correct_2') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('option_3') ? 'has-error' : '' }}">
                            <label for="option_3">Option 3</label>
                            <input style="width: 100%; padding: 4px;" type="text" name="option_3" id="option_3" value="{{ old('option_3', '') }}">
                            @if($errors->has('option_3'))
                                <span class="help-block" role="alert">{{ $errors->first('option_3') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('correct_3') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="correct_3" value="0">
                                <input type="checkbox" name="correct_3" id="correct_3" value="1" {{ old('correct_3', 0) == 1 ? 'checked' : '' }}>
                                <label for="correct_3" style="font-weight: 400">Correct 3</label>
                            </div>
                            @if($errors->has('correct_3'))
                                <span class="help-block" role="alert">{{ $errors->first('correct_3') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('option_4') ? 'has-error' : '' }}">
                            <label for="option_4">Option 4</label>
                            <input style="width: 100%; padding: 4px;" type="text" name="option_4" id="option_4" value="{{ old('option_4', '') }}">
                            @if($errors->has('option_4'))
                                <span class="help-block" role="alert">{{ $errors->first('option_4') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('correct_4') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="correct_4" value="0">
                                <input type="checkbox" name="correct_4" id="correct_4" value="1" {{ old('correct_4', 0) == 1 ? 'checked' : '' }}>
                                <label for="correct_4" style="font-weight: 400">Correct 4</label>
                            </div>
                            @if($errors->has('correct_4'))
                                <span class="help-block" role="alert">{{ $errors->first('correct_4') }}</span>
                            @endif
                        </div>

                            <button class="action-btn-delete" type="submit">
                                Enregistrer
                            </button>

                    </form>
                </div>
            </div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.questions.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($question) && $question->image)
      var file = {!! json_encode($question->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $question->image->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
