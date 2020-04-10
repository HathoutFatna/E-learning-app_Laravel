@extends('layouts.admin')
@section('content')
    <div style="margin: 20px;">
        <h4>
            Modifier une catégorie </h4>
        <div style="border: solid 1px grey; padding: 20px;">
            <form method="POST" action="{{ route("admin.categories.update", [$category->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">

                    <label for="nom">Nom de la catégorie</label>
                    <input style="width: 100%; padding: 4px;" type="text" name="nom" id="nom" value="{{ old('nom', $category->nom) }}" required>
                    @if($errors->has('nom'))
                        <span class="help-block" role="alert">{{ $errors->first('nom') }}</span>
                    @endif
                </div>

                <button class="action-btn-delete" type="submit">
                   Enregistrer
                </button>
            </form>
        </div>
    </div>

@endsection


