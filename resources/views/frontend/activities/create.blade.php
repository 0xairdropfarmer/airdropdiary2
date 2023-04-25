@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.activity.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.activities.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="user_id">{{ trans('cruds.activity.fields.user') }}</label>
                            <select class="form-control select2" name="user_id" id="user_id">
                                @foreach($users as $id => $entry)
                                    <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="task_id" id="task_id">
                                @foreach($tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <input class="form-control" type="number" name="total_interact" id="total_interact" value="{{ old('total_interact', '') }}" step="1">
                            @if($errors->has('total_interact'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_interact') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.total_interact_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.activity.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '') }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_gas_spend">{{ trans('cruds.activity.fields.total_gas_spend') }}</label>
                            <input class="form-control" type="number" name="total_gas_spend" id="total_gas_spend" value="{{ old('total_gas_spend', '') }}" step="0.01">
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

        </div>
    </div>
</div>
@endsection