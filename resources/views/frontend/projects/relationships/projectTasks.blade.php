
<div class="card">
    <div class="card-header">
     One time   {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div> 
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-projectTasks">
                <thead>
                    <tr>
                        
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.task.fields.link') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                        @if($task->type == 'onetime')
                        <tr data-entry-id="{{ $task->id }}">
                          
                            <td>
                                {{ $task->name ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" target="_blank" href=" {{ $task->link ?? '' }}" >
                                 destination task Link
                               </a>
                             
                            </td> 
                            <td>
                                @can('task_show')  
                                @if(!empty($tasks_done)) 
                                  @foreach($tasks_done as $key => $task_done)
                                  
                                    @if($task_done == $task->id) 
                                    <a class="btn btn-xs btn-success disabled">
                                         done
                                    </a> 
                                    @break
                                    @else  
                                        <a class="btn btn-xs btn-primary" href="{{ route('frontend.activities.create',  ['id' => $task->id,'name'=>$task->name]) }}">
                                            Mark as done
                                        </a>
                                    @endif 
                                   
                                    @endforeach
                                    @else
                                    <a class="btn btn-xs btn-primary" href="{{ route('frontend.activities.create',  ['id' => $task->id,'name'=>$task->name]) }}">
                                        Mark as done
                                    </a>
                                    @endif
                                @endcan

                               

                            </td>

                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
     Reccuring   {{ trans('cruds.task.title_singular') }} {{ trans('global.list') }}
    </div> 
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-projectTasks">
                <thead>
                    <tr>
                        
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <th>
                           destination task Link
                        </th> 
                        <th>
                           view history
                         </th> 
                        <th>
                             total interactions
                        </th> 
                        <th>
                            total spend 
                       </th> 
                       <th>
                        total gas spend
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                        @if($task->type == 'recurring')
                        <tr data-entry-id="{{ $task->id }}">
                          
                            <td>
                                {{ $task->name ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-info" target="_blank" href=" {{ $task->link ?? '' }}" >
                                 View Link
                               </a>
                             
                            </td> 
                            <td>
                                <a class="btn btn-xs btn-info" target="_blank" href="{{ route('frontend.activities.recurringTaskView',  ['id' => $task->id,'name'=>$task->name]) }}" >
                                    View history
                                  </a>
                            </td>
                            @foreach($total_actions as $key => $total_action)
                            @if($total_action->task_id == $task->id)
                            <td>
                                {{ $total_action->interact_total ?? '' }}
                            </td>
                            <td>
                                {{ $total_action->total_amount ?? '' }}
                            </td>
                            <td>
                                {{ $total_action->total_gas_spend ?? '' }}
                            </td>
                            @endif
                            @endforeach
                            <td>
                                @can('task_show')  
                             
                                        <a class="btn btn-xs btn-primary" href="{{ route('frontend.activities.create',  ['id' => $task->id,'name'=>$task->name]) }}">
                                            Add more action
                                        </a>
                                  
                                @endcan

                               

                            </td>

                        </tr>
                        @endif
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
    url: "{{ route('admin.tasks.massDestroy') }}",
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