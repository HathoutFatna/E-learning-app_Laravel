<div class="content">
    @can('quiz_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.quizzes.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.quiz.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.quiz.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Quiz">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.questions') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.cours') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.titre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.quiz.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $key => $quiz)
                                    <tr data-entry-id="{{ $quiz->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $quiz->id ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($quiz->questions as $key => $item)
                                                <span class="label label-info label-many">{{ $item->texte }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $quiz->cours->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->titre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $quiz->updated_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('quiz_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.quizzes.show', $quiz->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('quiz_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.quizzes.edit', $quiz->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('quiz_delete')
                                                <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('quiz_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.quizzes.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Quiz:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection