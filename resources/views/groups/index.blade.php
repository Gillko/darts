@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Groups</h2>
            <a href="{{ url('/groups/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>

            @foreach($groups as $group)
                <p>{{ $group->name }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
