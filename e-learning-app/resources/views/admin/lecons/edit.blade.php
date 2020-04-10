@extends('layouts.admin')
@section('content')
<div style="margin: 20px;">
    <h4>
        Modifier une leçon </h4>
    <div style="border: solid 1px grey; padding: 20px;">
        <form method="POST" action="{{ route("admin.lecons.update", [$lecon->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="{{ $errors->has('chapitre') ? 'has-error' : '' }}">
                <label for="chapitre_id">Chapitre</label>
                <select class=" select2" style="width: 100%; padding: 4px;" name="chapitre_id" id="chapitre_id">
                    @foreach($chapitres as $id => $chapitre)
                        <option value="{{ $id }}" {{ ($lecon->chapitre ? $lecon->chapitre->id : old('chapitre_id')) == $id ? 'selected' : '' }}>{{ $chapitre }}</option>
                    @endforeach
                </select>
                @if($errors->has('chapitre_id'))
                    <span class="help-block" role="alert">{{ $errors->first('chapitre_id') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('titre') ? 'has-error' : '' }}">
                <label class="required" for="titre">Titre</label>
                <input style="width: 100%; padding: 4px;" type="text" name="titre" id="titre" value="{{ old('titre', $lecon->titre) }}" required>
                @if($errors->has('titre'))
                    <span class="help-block" role="alert">{{ $errors->first('titre') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('images') ? 'has-error' : '' }}">
                <label for="images">Images</label>
                <div class="needsclick dropzone" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <span class="help-block" role="alert">{{ $errors->first('images') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('fichiers') ? 'has-error' : '' }}">
                <label for="fichiers">Fichiers</label>
                <div class="needsclick dropzone" id="fichiers-dropzone">
                </div>
                @if($errors->has('fichiers'))
                    <span class="help-block" role="alert">{{ $errors->first('fichiers') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea style="width: 100%; padding: 4px;" name="description" id="description">{{ old('description', $lecon->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('texte_long') ? 'has-error' : '' }}">
                <label for="texte_long">Contenu de la leçon</label>
                <textarea style="width: 100%; padding: 4px;" name="texte_long" id="texte_long">{{ old('texte_long', $lecon->texte_long) }}</textarea>
                @if($errors->has('texte_long'))
                    <span class="help-block" role="alert">{{ $errors->first('texte_long') }}</span>
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
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.lecons.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lecon) && $lecon->images)
      var files =
        {!! json_encode($lecon->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
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
    var uploadedFichiersMap = {}
Dropzone.options.fichiersDropzone = {
    url: '{{ route('admin.lecons.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="fichiers[]" value="' + response.name + '">')
      uploadedFichiersMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFichiersMap[file.name]
      }
      $('form').find('input[name="fichiers[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($lecon) && $lecon->fichiers)
          var files =
            {!! json_encode($lecon->fichiers) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="fichiers[]" value="' + file.file_name + '">')
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
