<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('project_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.projects.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.project.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    your ongoing project
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Project">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.project.fields.name') }}
                                    </th>
                                   
                                    <th>
                                        {{ trans('cruds.project.fields.airdropcf') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.raisefund') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.categories') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.project.fields.tag') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                         
                            </thead>
                            <tbody>  
                                @if(empty($projects))
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                        <p>ดูเหมือนว่าคุณจะไม่ได้เริ่มทำเควสเลย</p>
                                        <div class="col-lg-12">
                                            <a class="btn btn-success" href="{{ route('frontend.projects.index') }}">
                                               เพิ่มกิจกรรม
                                            </a>
                                        </div>
                                       </div>
                                    </td>
                                </tr>
                                @else
                               
                                @foreach($projects as $key => $project)
                                    <tr data-entry-id="{{ $project->id }}">
                                      
                                        <td>
                                            {{ $project->name ?? '' }}
                                        </td>
                                        
                                        <td>
                                            {{ App\Models\Project::AIRDROPCF_RADIO[$project->airdropcf] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $project->raisefund ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($project->categories as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($project->tags as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('project_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.projects.show', $project->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('project_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.projects.edit', $project->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('project_delete')
                                                <form action="{{ route('frontend.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>