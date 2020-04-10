@extends('layouts.admin')
@section('content')
<div>
    @can('cour_create')
                <a class="add-btn-index" href="{{ route("admin.cours.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter un cours
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des cours</caption>
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    @if (Auth::user()->isAdmin())
                                    <th>
                                        Enseignants
                                    </th>
                                    @endif
                                    <th>
                                        Titre
                                    </th>
                                    <th>
                                       Catégorie
                                    </th>
                                    <th>
                                        Description
                                    </th>
                                    <th>
                                        Image
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
                                @foreach($cours as $key => $cour)
                                    <tr data-entry-id="{{ $cour->id }}">
                                        <td>
                                            {{ $cour->id ?? '' }}
                                        </td>
                                        @if (Auth::user()->isAdmin() )
                                        <td>
                                            @foreach($cour->enseignants as $key => $item)
                                                <span class="action-btn action-btn-edit">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        @endif
                                        <td>
                                            {{ $cour->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cour->category->nom ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cour->description ?? '' }}
                                        </td>
                                        <td>
                                            @if($cour->image)
                                                <a href="{{ $cour->image->getUrl() }}" target="_blank">
                                                    <img src="{{ $cour->image->getUrl() }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $cour->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cour->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('cour_show')
                                                <a class="action-btn action-btn-primary" href="{{ route('admin.chapitres.index',[ 'cours_id' => $cour->id]) }}">
                                                    {{ trans('Chapitres') }}
                                                </a>
                                            @endcan

                                            @can('cour_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.cours.edit', $cour->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('cour_delete')
                                                <form action="{{ route('admin.cours.destroy', $cour->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
