@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
       
    </div>
    <div class="row justify-content-center">
        
    @include('frontend.home.project', ['projects' => $uniqueProject])
 
       
</div>
</div>
@endsection