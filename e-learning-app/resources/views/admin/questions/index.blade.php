@extends('layouts.admin')
@section('content')
<div>
    @can('question_create')
                <a class="add-btn-index" href="{{ route("admin.questions.create") }}">
                    <i class="fas fa-fw fa-plus">

                    </i> Ajouter une question
                </a>
    @endcan
                        <table class="content-table">
                            <caption>Liste des questions</caption>
                            <thead>
                                <tr>
                                    <th>
                                       ID
                                    </th>
                                    <th>
                                        Question
                                    </th>
                                    <th>
                                       Score
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
                                @foreach($questions as $key => $question)
                                    <tr data-entry-id="{{ $question->id }}">
                                        <td>
                                            {{ $question->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->texte ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->score ?? '' }}
                                        </td>
                                        <td>
                                            @if($question->image)
                                                <a href="{{ $question->image->getUrl() }}" target="_blank">
                                                    <img src="{{ $question->image->getUrl('thumb') }}" width="50px" height="50px">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $question->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $question->updated_at ?? '' }}
                                        </td>
                                        <td>


                                            @can('question_edit')
                                                <a class="action-btn action-btn-edit" href="{{ route('admin.questions.edit', $question->id) }}">
                                                    Modifier
                                                </a>
                                            @endcan

                                            @can('question_delete')
                                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
