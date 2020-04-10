<div class="content">
    @can('lecon_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.lecons.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.lecon.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.lecon.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Lecon">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.chapitre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.titre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.position') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lecon.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lecons as $key => $lecon)
                                    <tr data-entry-id="{{ $lecon->id }}">
                                        <td>

                                        </td>
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
                                            {{ $lecon->description ?? '' }}
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
                                            @can('lecon_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.lecons.show', $lecon->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('lecon_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.lecons.edit', $lecon->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('lecon_delete')
                                                <form action="{{ route('admin.lecons.destroy', $lecon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('lecon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lecons.massDestroy') }}",
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
  $('.datatable-Lecon:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection