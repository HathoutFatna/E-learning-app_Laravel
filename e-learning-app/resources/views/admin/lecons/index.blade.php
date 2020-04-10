@extends('layouts.admin')
@section('content')
<div>
    @can('lecon_create')
                <a class="add-btn-index" href="{{ route("admin.lecons.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter une leçon
                </a>
    @endcan
                        <table class="content-table" >
                            <caption>Liste des leçons</caption>
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Chapitre
                                    </th>
                                    <th>
                                       Titre
                                    </th>
                                    <th>
                                        Position
                                    </th>
                                    <th>
                                       Date création
                                    </th>
                                    <th>
                                        Date modification
                                    </th>
                                    <th>
                                       Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecons as $key => $lecon)
                                    <tr data-entry-id="{{ $lecon->id }}">
                                        <td>
                                            {{ $lecon->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lecon->chapitre->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lecon->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lecon->position ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lecon->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lecon->updated_at ?? '' }}
                                        </td>
                                        <td>

                                            @can('lecon_edit')
                                                <a class="action-btn action-btn-edit " href="{{ route('admin.lecons.edit', $lecon->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('lecon_delete')
                                                <form action="{{ route('admin.lecons.destroy', $lecon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
