@extends('layouts.admin')
@section('content')
<div>
    @can('user_create')
                <a class="add-btn-index" href="{{ route("admin.users.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter un utilisateur
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des utilisateurs</caption>
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nom
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Date vérification Email
                                    </th>
                                    <th>
                                       Rôles
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td>
                                            {{ $user->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email_verified_at ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($user->roles as $key => $item)
                                                <span class="action-btn action-btn-label">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>

                                            @can('user_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.users.edit', $user->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('user_delete')
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="action-btn-delete" value="Supprimer">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
@endsection
