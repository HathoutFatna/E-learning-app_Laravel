@extends('layouts.admin')
@section('content')
    <div style="margin: 20px;">
    <h4>
                    Ajouter un cours </h4>
        <div style="border: solid 1px grey; padding: 20px;">
                    <form method="POST" action="{{ route("admin.cours.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="{{ $errors->has('enseignants') ? 'has-error' : '' }}">
                            @if (Auth::user()->isAdmin())
                            <label for="enseignants">Enseignants</label>
                            <div style="padding-bottom: 10px">
                                <span class=" action-btn action-btn-primary select-all" style="border-radius: 0">Sélectionner tous</span>
                                <span class="action-btn action-btn-primary deselect-all" style="border-radius: 0">Supprimer tous</span>
                            </div>
                            <select class=" select2" style="width: 100%; padding: 4px;" name="enseignants[]" id="enseignants" multiple>
                                @foreach($enseignants as $id => $enseignants)
                                    <option value="{{ $id }}" {{ in_array($id, old('enseignants', [])) ? 'selected' : '' }}>{{ $enseignants }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('enseignants'))
                                <span class="help-block" role="alert">{{ $errors->first('enseignants') }}</span>
                            @endif
                                @endif
                        </div>
                        <div >
                            <label for="categories_id">Catégorie</label>
                            <select class=" select2" style="width: 100%; padding: 4px;" name="categories_id" id="categories_id">
                                @foreach($category as $id => $category)
                                    <option value="{{ $id }}" {{ old('categories_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categories_id'))
                                <span class="help-block" role="alert">{{ $errors->first('categories_id') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('titre') ? 'has-error' : '' }}">
                            <label class="required" for="titre">Titre</label>
                            <input style="width: 100%; padding: 4px;" type="text" name="titre" id="titre" value="{{ old('titre', '') }}" required>
                            @if($errors->has('titre'))
                                <span class="help-block" role="alert">{{ $errors->first('titre') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Description</label>
                            <textarea style="width: 100%; padding: 4px;" name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
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
                        <div >
                            <button class="action-btn-delete" style="padding: 10px;" type="submit">
                                Enregistrer
                            </button>
                        </div>
                    </form>
    </div>

@endsection
@section('scripts')
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.cours.storeMedia') }}',
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
                    @if(isset($cour) && $cour->image)
                var file = {!! json_encode($cour->image) !!}
                        this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, '{{ $cour->image->getUrl('thumb') }}')
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response
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
