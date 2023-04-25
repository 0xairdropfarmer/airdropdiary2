@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.activity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.activities.update", [$activity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.activity.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $activity->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="task_id">{{ trans('cruds.activity.fields.task') }}</label>
                <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id" id="task_id">
                    @foreach($tasks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('task_id') ? old('task_id') : $activity->task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('task'))
                    <div class="invalid-feedback">
                        {{ $errors->first('task') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.task_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_interact">{{ trans('cruds.activity.fields.total_interact') }}</label>
                <input class="form-control {{ $errors->has('total_interact') ? 'is-invalid' : '' }}" type="number" name="total_interact" id="total_interact" value="{{ old('total_interact', $activity->total_interact) }}" step="1">
                @if($errors->has('total_interact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_interact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.total_interact_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_amount">{{ trans('cruds.activity.fields.total_amount') }}</label>
                <input class="form-control {{ $errors->has('total_amount') ? 'is-invalid' : '' }}" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', $activity->total_amount) }}" step="0.01">
                @if($errors->has('total_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.total_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_gas_spend">{{ trans('cruds.activity.fields.total_gas_spend') }}</label>
                <input class="form-control {{ $errors->has('total_gas_spend') ? 'is-invalid' : '' }}" type="number" name="total_gas_spend" id="total_gas_spend" value="{{ old('total_gas_spend', $activity->total_gas_spend) }}" step="0.01">
                @if($errors->has('total_gas_spend'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_gas_spend') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.activity.fields.total_gas_spend_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection