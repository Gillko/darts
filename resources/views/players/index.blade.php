@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Players</h2>
            <a href="{{ url('/players/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>

            @foreach($players as $player)
                <p>{{ $player->firstname }} {{ $player->lastname }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection