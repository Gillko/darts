@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Dashboard</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <ul>
                <li><a href="{{ url('/groups') }}">groups</a></li>
                <li><a href="{{ url('/players') }}">players</a></li>
                <li><a href="{{ url('/games') }}">games</a></li>
                <li><a href="{{ url('/scores') }}">scores</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
