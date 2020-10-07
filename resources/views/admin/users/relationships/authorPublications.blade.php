@can('publication_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.publications.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.publication.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.publication.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-authorPublications">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.edition') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.database') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.document') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.author') }}
                        </th>
                        <th>
                            {{ trans('cruds.publication.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publications as $key => $publication)
                        <tr data-entry-id="{{ $publication->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $publication->id ?? '' }}
                            </td>
                            <td>
                                {{ $publication->title ?? '' }}
                            </td>
                            <td>
                                {{ $publication->date ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Publication::EDITION_SELECT[$publication->edition] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Publication::DATABASE_SELECT[$publication->database] ?? '' }}
                            </td>
                            <td>
                                @if($publication->document)
                                    <a href="{{ $publication->document->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $publication->author->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Publication::TYPE_SELECT[$publication->type] ?? '' }}
                            </td>
                            <td>
                                @can('publication_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.publications.show', $publication->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('publication_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.publications.edit', $publication->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('publication_delete')
                                    <form action="{{ route('admin.publications.destroy', $publication->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('publication_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.publications.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-authorPublications:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection