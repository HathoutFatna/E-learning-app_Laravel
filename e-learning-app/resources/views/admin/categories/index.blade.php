@extends('layouts.admin')
@section('content')
    <div>
            <a class="add-btn-index" href="{{ route("admin.categories.create") }}">
                <i class="fas fa-fw fa-plus">

                </i> Ajouter une catégorie
            </a>
        <table class="content-table">
            <caption>Liste des catégories</caption>
            <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Nom
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
            @foreach($categories as $key => $category)
                <tr data-entry-id="{{ $category->id }}">
                    <td>
                        {{ $category->id ?? '' }}
                    </td>
                    <td>
                        {{ $category->nom ?? '' }}
                    </td>
                    <td>
                        {{ $category->created_at ?? '' }}
                    </td>
                    <td>
                        {{ $category->updated_at ?? '' }}
                    </td>
                    <td>


                            <a class="action-btn action-btn-edit" href="{{ route('admin.categories.edit', $category->id) }}">
                                Modifier
                            </a>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

