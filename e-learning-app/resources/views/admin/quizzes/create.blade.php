@extends('layouts.admin')
@section('content')
    <div style="margin: 20px;">
        <h4>
            Ajouter un quiz </h4>
        <div style="border: solid 1px grey; padding: 20px;">
                    <form method="POST" action="{{ route("admin.quizzes.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class=" {{ $errors->has('questions') ? 'has-error' : '' }}">
                            <label class="required" for="questions">Questions</label>
                            <div style="padding-bottom: 4px">
                                <span class="action-btn action-btn-primary select-all" style="border-radius: 0">Sélectionner tous</span>
                                <span class="action-btn action-btn-primary deselect-all" style="border-radius: 0">Supprimer tous</span>
                            </div>
                            <select class="select2" style="width: 100%; padding: 4px;"  name="questions[]" id="questions" multiple required>
                                @foreach($questions as $id => $questions)
                                    <option value="{{ $id }}" {{ in_array($id, old('questions', [])) ? 'selected' : '' }}>{{ $questions }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('questions'))
                                <span class="help-block" role="alert">{{ $errors->first('questions') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('cours') ? 'has-error' : '' }}">
                            <label for="cours_id">Cours</label>
                            <select class=" select2" style="width: 100%; padding: 4px;"  name="cours_id" id="cours_id">
                                @foreach($cours as $id => $cours)
                                    <option value="{{ $id }}" {{ old('cours_id') == $id ? 'selected' : '' }}>{{ $cours }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('cours_id'))
                                <span class="help-block" role="alert">{{ $errors->first('cours_id') }}</span>
                            @endif
                        </div>
                        <div class=" {{ $errors->has('titre') ? 'has-error' : '' }}">
                            <label class="required" for="titre">Titre</label>
                            <input style="width: 100%; padding: 4px;"  type="text" name="titre" id="titre" value="{{ old('titre', '') }}" required>
                            @if($errors->has('titre'))
                                <span class="help-block" role="alert">{{ $errors->first('titre') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">Description</label>
                            <textarea style="width: 100%; padding: 4px;"  name="description" id="description">{{ old('description') }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                            <button class="action-btn-delete" type="submit">
                                Enregistrer
                            </button>

                    </form>
                </div>
            </div>



@endsection
