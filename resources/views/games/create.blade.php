@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ __('Create Game') }}</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('games.store') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <label for="date">{{ __('Date') }}</label>
                    <input id="date" type="text" class="form-control" name="date" value="{{ date('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="hour">{{ __('Hour') }}</label>
                    <input id="hour" type="text" class="form-control" name="hour" value="{{ date('H:i:s') }}">
                </div>

                 <div class="form-group">
                    <label for="players">{{ __('Players') }}</label>
                    <select name="player_list[]" id="players" class="form-control" multiple>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->firstname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="players">{{ __('Winner') }}</label>
                    <select name="winner" id="players" class="form-control">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}">{{ $player->firstname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Game') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection