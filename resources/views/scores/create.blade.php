@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ __('Create Score') }}</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('scores.store') }}">
                @csrf

                <div class="form-group">
                    <label for="arrow">{{ __('Arrow') }}</label>
                    <input id="arrow" type="text" class="form-control" name="arrow">
                </div>

                <div class="form-group">
                    <label for="score">{{ __('Score') }}</label>
                    <input id="score" type="text" class="form-control" name="score">
                </div>

                <div class="form-group">
                    <label for="player_id">{{ __('Player') }}</label>
                    <select name="player_id" id="players" class="form-control">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->nickname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="game_id">{{ __('Games') }}</label>
                    <select name="game_id" id="games" class="form-control">
                        @foreach($games as $game)
                            <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Score') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection