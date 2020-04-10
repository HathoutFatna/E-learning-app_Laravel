<div class="content">
    @can('chapitre_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.chapitres.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.chapitre.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.chapitre.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Chapitre">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.cours') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.titre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.position') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.created_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.chapitre.fields.updated_at') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($chapitres as $key => $chapitre)
                                    <tr data-entry-id="{{ $chapitre->id }}">
                                        <td>

                                        </td>
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
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.chapitres.show', $chapitre->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('chapitre_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.chapitres.edit', $chapitre->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('chapitre_delete')
                                                <form action="{{ route('admin.chapitres.destroy', $chapitre->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('chapitre_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.chapitres.massDestroy') }}",
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
  $('.datatable-Chapitre:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection