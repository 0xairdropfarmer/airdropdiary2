@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ $strategy->name }}   
                </div>

                <div class="card-body">
                   
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('frontend.strategies.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                        <a class="btn btn-primary disabled right" href="#">
                            expire at {{ $strategy->expire_date }}
                        </a>
                    </div>  
                      <div class="form-group">
                    <img class="responsive-image img-thumbnail align-center" src="{{ $strategy->cover->getUrl() }}" alt="Responsive Image">
                </div>  
                    <div class="form-group">
                        
                                    @include('frontend.strategies.relationships.taskStrategies', ['tasks' => $strategy->tasks])
                                   
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection