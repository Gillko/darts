@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h2 class="title-d">Groups</h2>
            <a class="create-d" href="{{ url('/groups/create') }}">
              <button class="btn btn-primary">
                <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
              </button>
            </a>

            <div class="foreach-d">
	            @foreach($groups as $group)
	                <p>{{ $group->name }}</p>
	            @endforeach
	        </div>
        </div>
    </div>
</div>
@endsection
