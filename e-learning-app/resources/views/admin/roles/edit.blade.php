@extends('layouts.admin')
@section('content')

<div style="margin: 20px;">
    <h4>
        Modifier un rôle </h4>
    <div style="border: solid 1px grey; padding: 20px;">
        <form method="POST" action="{{ route("admin.roles.update", [$role->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div>
                <label class="required" for="title">Titre </label>
                <input type="text" style="width: 100%; padding: 4px;" name="title" id="title" value="{{ old('title', $role->title) }}" required>
                @if($errors->has('title'))
                    <span class="help-block" role="alert">{{ $errors->first('title') }}</span>
                @endif
            </div>
            <div>
                <label class="required" for="permissions">Permissions </label>
                <div style="padding-bottom: 4px">
                    <span class="action-btn action-btn-primary select-all" style="border-radius: 0">Sélectionner tous</span>
                    <span class="action-btn action-btn-primary deselect-all" style="border-radius: 0">Supprimer tout</span>
                </div>
                <select class="select2" style="width: 100%; padding: 4px;" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <span class="help-block" role="alert">{{ $errors->first('permissions') }}</span>
                @endif
            </div>

            <button class="action-btn-delete" type="submit">
                Enregistrer
            </button>

        </form>
    </div>
</div>
@endsection
