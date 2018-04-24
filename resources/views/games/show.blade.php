@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Games</h2>
            <p>{{ $game->name }} - {{ $game->date }} - {{ $game->hour }}</p>
            <h4>Winner</h4>
            <p>{{ $game->winner }}</p>
            <h4>Players for this game</h4>
            @foreach ($game->players as $player)
                <p><a href="{{ URL::to('/players/' . $player->id) }}">{{ $player->firstname }} {{ $player->lastname }}</a></p>
            @endforeach
        </div>
    </div>
</div>
@endsection