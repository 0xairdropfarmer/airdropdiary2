@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.project.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
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
                            {{ trans('cruds.project.fields.tag') }}
                        </th>
                        <td>
                            @foreach($project->tags as $key => $tag)
                                <span class="label label-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.logo') }}
                        </th>
                        <td>
                            @if($project->logo)
                                <a href="{{ $project->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $project->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.project.fields.cover') }}
                        </th>
                        <td>
                            @if($project->cover)
                                <a href="{{ $project->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $project->cover->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.projects.index') }}">
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
            <a class="nav-link" href="#project_tasks" role="tab" data-toggle="tab">
                {{ trans('cruds.task.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="project_tasks">
            @includeIf('admin.projects.relationships.projectTasks', ['tasks' => $project->projectTasks])
        </div>
    </div>
</div>

@endsection