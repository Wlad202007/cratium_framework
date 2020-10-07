@can('activity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.activities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.activity.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.activity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-authorActivities">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.score') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.duration') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.time_start') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.time_end') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.mode') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.course') }}
                        </th>
                        <th>
                            {{ trans('cruds.activity.fields.moderator') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $key => $activity)
                        <tr data-entry-id="{{ $activity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $activity->id ?? '' }}
                            </td>
                            <td>
                                {{ $activity->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Activity::TYPE_SELECT[$activity->type] ?? '' }}
                            </td>
                            <td>
                                {{ $activity->score ?? '' }}
                            </td>
                            <td>
                                {{ $activity->duration ?? '' }}
                            </td>
                            <td>
                                {{ $activity->time_start ?? '' }}
                            </td>
                            <td>
                                {{ $activity->time_end ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Activity::MODE_SELECT[$activity->mode] ?? '' }}
                            </td>
                            <td>
                                {{ $activity->course->name ?? '' }}
                            </td>
                            <td>
                                {{ $activity->moderator->name ?? '' }}
                            </td>
                            <td>
                                @can('activity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.activities.show', $activity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('activity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.activities.edit', $activity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('activity_delete')
                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('activity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.activities.massDestroy') }}",
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
  let table = $('.datatable-authorActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection