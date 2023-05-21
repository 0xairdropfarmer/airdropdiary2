 

<div class="card">
    <div class="card-header">
        {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div> 
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-projectTasks">
                <thead>
                    <tr>
                       
                        <th>
                            {{ trans('cruds.task.fields.project') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.phase') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
          
                    @foreach($tasks as $key => $task)
          
                        <tr data-entry-id="{{ $task->id }}">
                           
                            <td>
                                {{ $task->project->name ?? '' }}
                            </td>
                            <td>
                                {{ $task->name ?? '' }}
                            </td>
                            <td>
                                {{ $task->link ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Task::TYPE_RADIO[$task->type] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Task::PHASE_RADIO[$task->phase] ?? '' }}
                            </td>
                            <td>
                                @can('task_show')  
                             
                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.activities.create',  ['id' => $task->id,'name'=>$task->name]) }}">
                                   เพิ่มกิจกรรม
                                </a>
                                @can('todo_create') 
                     
                                <a class="btn btn-xs btn-warning" href="{{ route('frontend.todos.create',  ['id' => $task->id,'name'=>$task->name]) }}">
                                   เก็บไว้ทำวันหลัง
                                </a>
                           
                                @endcan
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
@can('task_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.tasks.massDestroy') }}",
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
  let table = $('.datatable-projectTasks:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection