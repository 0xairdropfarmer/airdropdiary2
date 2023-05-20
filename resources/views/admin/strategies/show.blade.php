@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.strategy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.strategies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.strategy.fields.id') }}
                        </th>
                        <td>
                            {{ $strategy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.strategy.fields.name') }}
                        </th>
                        <td>
                            {{ $strategy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.strategy.fields.task') }}
                        </th>
                        <td>
                            @foreach($strategy->tasks as $key => $task)
                                <span class="label label-info">{{ $task->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.strategy.fields.cover') }}
                        </th>
                        <td>
                            @if($strategy->cover)
                                <a href="{{ $strategy->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $strategy->cover->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.strategy.fields.expire_date') }}
                        </th>
                        <td>
                            {{ $strategy->expire_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.strategies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection