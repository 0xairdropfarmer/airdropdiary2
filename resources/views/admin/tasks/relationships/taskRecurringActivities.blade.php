@can('recurring_activity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.recurring-activities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.recurringActivity.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.recurringActivity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-taskRecurringActivities">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.task') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.total_interact') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.total_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.total_gas_spend') }}
                        </th>
                        <th>
                            {{ trans('cruds.recurringActivity.fields.done') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recurringActivities as $key => $recurringActivity)
                        <tr data-entry-id="{{ $recurringActivity->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $recurringActivity->id ?? '' }}
                            </td>
                            <td>
                                {{ $recurringActivity->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $recurringActivity->task->name ?? '' }}
                            </td>
                            <td>
                                {{ $recurringActivity->total_interact ?? '' }}
                            </td>
                            <td>
                                {{ $recurringActivity->total_amount ?? '' }}
                            </td>
                            <td>
                                {{ $recurringActivity->total_gas_spend ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\RecurringActivity::DONE_RADIO[$recurringActivity->done] ?? '' }}
                            </td>
                            <td>
                                @can('recurring_activity_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.recurring-activities.show', $recurringActivity->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('recurring_activity_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.recurring-activities.edit', $recurringActivity->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('recurring_activity_delete')
                                    <form action="{{ route('admin.recurring-activities.destroy', $recurringActivity->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('recurring_activity_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.recurring-activities.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-taskRecurringActivities:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection