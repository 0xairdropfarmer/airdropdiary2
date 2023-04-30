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
                        <input id="user_id"
                        type="hidden"
                        name="user_id"
                        value="{{ auth()->user()->id }}">
                        <input id="task_id"
                        type="hidden"
                        name="task_id"
                        value="{{ request('id') }}">
                        <div class="form-group">
                            <label>{{ trans('cruds.activity.fields.done') }}</label>
                            @foreach(App\Models\Activity::DONE_RADIO as $key => $label)
                                <div>
                                    <input type="radio" id="done_{{ $key }}" name="done" value="{{ $key }}" {{ old('done', 'notdone') === (string) $key ? 'checked' : '' }}>
                                    <label for="done_{{ $key }}">{{ $label }}</label>
                                </div>
                            @endforeach
                            @if($errors->has('done'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('done') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.done_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="note">รายละเอียดเพิ่มเติม</label>
                            <textarea class="form-control ckeditor" name="note" id="note">{!! old('note') !!}</textarea>
                            @if($errors->has('note'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('note') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.category.fields.note_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_amount">{{ trans('cruds.activity.fields.total_amount') }}</label>
                            <input class="form-control" type="number" name="total_amount" id="total_amount" value="{{ old('total_amount', '0') }}" step="0.01">
                            @if($errors->has('total_amount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('total_amount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.activity.fields.total_amount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="total_gas_spend">{{ trans('cruds.activity.fields.total_gas_spend') }}</label>
                            <input class="form-control" type="number" name="total_gas_spend" id="total_gas_spend" value="{{ old('total_gas_spend', '0') }}" step="0.01">
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