@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.activity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.id') }}
                        </th>
                        <td>
                            {{ $activity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.user') }}
                        </th>
                        <td>
                            {{ $activity->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.task') }}
                        </th>
                        <td>
                            {{ $activity->task->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.total_interact') }}
                        </th>
                        <td>
                            {{ $activity->total_interact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.total_amount') }}
                        </th>
                        <td>
                            {{ $activity->total_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.total_gas_spend') }}
                        </th>
                        <td>
                            {{ $activity->total_gas_spend }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.activity.fields.done') }}
                        </th>
                        <td>
                            {{ App\Models\Activity::DONE_RADIO[$activity->done] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection