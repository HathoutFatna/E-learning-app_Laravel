@extends('layouts.admin')
@section('content')
<div>
    @can('quiz_create')
                <a class="add-btn-index" href="{{ route("admin.quizzes.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter un quiz
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des quiz</caption>
                            <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Questions
                                    </th>
                                    <th>
                                       Cours
                                    </th>
                                    <th>
                                        Titre
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
                                @foreach($quizzes as $key => $quiz)
                                    <tr data-entry-id="{{ $quiz->id }}">
                                        <td>
                                            {{ $quiz->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($quiz->questions as $key => $item)
                                                <span class="action-btn action-btn-edit">{{ $item->texte }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $quiz->cours->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->updated_at ?? '' }}
                                        </td>
                                        <td>

                                            @can('quiz_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.quizzes.edit', $quiz->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('quiz_delete')
                                                <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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


