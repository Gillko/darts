@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Games</h2>
            <a href="{{ url('/games/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>

            @foreach($games as $game)
                <a href="{{ URL::to('/games/' . $game->id) }}">
                	<p>{{ $game->name }} - {{ $game->date }} - {{ $game->hour }}</p>
	            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
