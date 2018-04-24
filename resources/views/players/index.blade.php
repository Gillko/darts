@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Players</h2>
            <a href="{{ url('/players/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>


            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Player ID</th>
                  <th scope="col">Player</th>
                  <th scope="col">Played games</th>
                  <th scope="col">Won games</th>
                  <th scope="col">Percentage</th>
                </tr>
              </thead>
              <tbody>
                @foreach($players as $player)
                    <tr>
                      <th scope="row">{{ $player->id }}</th>
                      <td>{{ $player->firstname }} {{ $player->lastname }}</td>
                      <td>{{ $player->games_count }}</td>
                      <td>{{ $player->won->count() }}</td>
                      <td>{{ ($player->won->count() / $player->games_count) * 100 }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection