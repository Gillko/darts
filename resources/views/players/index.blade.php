@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Players</h2>
            <a href="{{ url('/players/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>

            @foreach($players as $player)
                <p>{{ $player->id }}</p>
                <p>{{ $player->firstname }} {{ $player->lastname }}</p>
                <ul>
                	<li>Played games: {{ $player->games_count }}</li>
                	<li>Won games: {{ $player->won->count() }}</li>
                	{{-- @foreach($wongames as $wongame)
                		<li>Won games: {{ $wongame->games_count }}</li>
                	@endforeach --}}
                </ul>
            @endforeach

            {{-- @foreach($players as $player)
    
@endforeach --}}
        </div>
    </div>
</div>
@endsection