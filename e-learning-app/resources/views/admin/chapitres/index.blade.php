@extends('layouts.admin')
@section('content')
<div>
    @can('chapitre_create')
                <a class="add-btn-index" href="{{ route("admin.chapitres.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i>Ajouter un chapitre
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des chapitres</caption>
                            <thead>
                                <tr>
                                    <th>
                                       ID
                                    </th>
                                    <th>
                                        Cours
                                    </th>
                                    <th>
                                       Titre
                                    </th>
                                    <th>
                                       Description
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
                                @foreach($chapitres as $key => $chapitre)
                                    <tr data-entry-id="{{ $chapitre->id }}">
                                        <td>
                                            {{ $chapitre->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->cours->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->position ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $chapitre->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('chapitre_show')
                                                <a class="action-btn action-btn-primary" href="{{ route('admin.lecons.index',[ 'chapitre_id' => $chapitre->id]) }}">
                                                    {{ trans('Leçons') }}
                                                </a>
                                            @endcan

                                            @can('chapitre_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.chapitres.edit', $chapitre->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('chapitre_delete')
                                                <form action="{{ route('admin.chapitres.destroy', $chapitre->id) }}" method="POST" onsubmit="return confirm('{{ trans('Êtes-vous sûr de vouloir Supprimer ?') }}');" style="display: inline-block;">
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
