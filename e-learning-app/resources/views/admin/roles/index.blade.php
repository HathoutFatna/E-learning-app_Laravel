@extends('layouts.admin')
@section('content')
<div>
    @can('role_create')
                <a class="add-btn-index" href="{{ route("admin.roles.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter un rôle
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des rôles</caption>
                            <thead>
                                <tr>
                                    <th>
                                      ID
                                    </th>
                                    <th>
                                        Titre
                                    </th>
                                    <th>
                                        Permissions
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                    <tr data-entry-id="{{ $role->id }}">
                                        <td>
                                            {{ $role->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $role->title ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($role->permissions as $key => $item)
                                                <span class="action-btn action-btn-label">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>

                                            @can('role_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.roles.edit', $role->id) }}">
                                                   Modifier
                                                </a>
                                            @endcan

                                            @can('role_delete')
                                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
