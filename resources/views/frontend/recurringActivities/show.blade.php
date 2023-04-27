@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.recurringActivity.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.recurring-activities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.task') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->task->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.total_interact') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->total_interact }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.total_amount') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->total_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.total_gas_spend') }}
                                    </th>
                                    <td>
                                        {{ $recurringActivity->total_gas_spend }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.recurringActivity.fields.done') }}
                                    </th>
                                    <td>
                                        {{ App\Models\RecurringActivity::DONE_RADIO[$recurringActivity->done] ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.recurring-activities.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection