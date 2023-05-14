@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.project.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.projects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $project->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $project->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $project->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.live') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Project::LIVE_RADIO[$project->live] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.airdropcf') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Project::AIRDROPCF_RADIO[$project->airdropcf] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.raisefund') }}
                                    </th>
                                    <td>
                                        {{ $project->raisefund }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.categories') }}
                                    </th>
                                    <td>
                                        @foreach($project->categories as $key => $categories)
                                            <span class="label label-info">{{ $categories->name }}</span>
                                        @endforeach
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
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.tag') }}
                                    </th>
                                    <td>
                                        @foreach($project->tags as $key => $tag)
                                            <span class="label label-info">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.projects.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                                 
                                @include('frontend.projects.relationships.projectTasks', ['tasks' => $project->projectTasks,'tasks_done'=>$tasks_done,'total_actions'=>$total_actions])
                         
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection