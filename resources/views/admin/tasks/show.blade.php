@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.task.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.id') }}
                        </th>
                        <td>
                            {{ $task->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.project') }}
                        </th>
                        <td>
                            {{ $task->project->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.name') }}
                        </th>
                        <td>
                            {{ $task->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.description') }}
                        </th>
                        <td>
                            {!! $task->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.link') }}
                        </th>
                        <td>
                            {{ $task->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Task::TYPE_RADIO[$task->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.phase') }}
                        </th>
                        <td>
                            {{ App\Models\Task::PHASE_RADIO[$task->phase] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.task.fields.expire_date') }}
                        </th>
                        <td>
                            {{ $task->expire_date }}
                        </td>
                    </tr>
                </tbody>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#task_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.activity.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#task_recurring_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.recurringActivity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="task_activities">
            @includeIf('admin.tasks.relationships.taskActivities', ['activities' => $task->taskActivities])
        </div>
        <div class="tab-pane" role="tabpanel" id="task_recurring_activities">
            @includeIf('admin.tasks.relationships.taskRecurringActivities', ['recurringActivities' => $task->taskRecurringActivities])
        </div>
    </div>
</div>

@endsection