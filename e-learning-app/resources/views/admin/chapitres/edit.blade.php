@extends('layouts.admin')
@section('content')
<div style="margin: 20px;">
    <h4>
        Modifier un chapitre </h4>
    <div style="border: solid 1px grey; padding: 20px;">
        <form method="POST" action="{{ route("admin.chapitres.update", [$chapitre->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="{{ $errors->has('cours') ? 'has-error' : '' }}">
                <label for="cours_id">Cours</label>
                <select class=" select2"  style="width: 100%; padding: 4px;" name="cours_id" id="cours_id">
                    @foreach($cours as $id => $cours)
                        <option value="{{ $id }}" {{ ($chapitre->cours ? $chapitre->cours->id : old('cours_id')) == $id ? 'selected' : '' }}>{{ $cours }}</option>
                    @endforeach
                </select>
                @if($errors->has('cours_id'))
                    <span class="help-block" role="alert">{{ $errors->first('cours_id') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('titre') ? 'has-error' : '' }}">
                <label class="required" for="titre">Titre du chapitre</label>
                <input style="width: 100%; padding: 4px;" type="text" name="titre" id="titre" value="{{ old('titre', $chapitre->titre) }}" required>
                @if($errors->has('titre'))
                    <span class="help-block" role="alert">{{ $errors->first('titre') }}</span>
                @endif
            </div>
            <div class="{{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea style="width: 100%; padding: 4px;" name="description" id="description">{{ old('description', $chapitre->description) }}</textarea>
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
