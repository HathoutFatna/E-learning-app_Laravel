@extends('layouts.admin')
@section('content')
    <div style="margin: 20px;">
        <h4>
            Ajouter un utilisateur </h4>
        <div style="border: solid 1px grey; padding: 20px;">
                    <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="{{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">Nom</label>
                            <input  style="width: 100%; padding: 4px;"type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">Email</label>
                            <input  style="width: 100%; padding: 4px;" type="text" name="email" id="email" value="{{ old('email') }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class=" {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="required" for="password">Mot de passe</label>
                            <input  style="width: 100%; padding: 4px;" type="password" name="password" id="password" required>
                            @if($errors->has('password'))
                                <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="{{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label class="required" for="roles">Rôles</label>
                            <div style="padding-bottom: 4px">
                                <span class="action-btn action-btn-primary select-all" style="border-radius: 0">Sélectionner tous</span>
                                <span class="action-btn action-btn-primary deselect-all" style="border-radius: 0">Supprimer tous</span>
                            </div>
                            <select class="select2" style="width: 100%; padding: 4px;" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="help-block" role="alert">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                            <button class="action-btn-delete" type="submit">
                                Enregistrer
                            </button>
                    </form>
                </div>
            </div>



@endsection
