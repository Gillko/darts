@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ __('Create Player') }}</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('players.store') }}">
                @csrf

                <div class="form-group">
                    <label for="firstname">{{ __('Firstname') }}</label>
                    <input id="firstname" type="text" class="form-control" name="firstname">
                </div>

                <div class="form-group">
                    <label for="lastname">{{ __('Lastname') }}</label>
                    <input id="lastname" type="text" class="form-control" name="lastname">
                </div>

                <div class="form-group">
                    <label for="nickname">{{ __('Nickname') }}</label>
                    <input id="nickname" type="text" class="form-control" name="nickname">
                </div>

                <div class="form-group">
                    <label for="groups">{{ __('Groups') }}</label>
                    <select name="group_list[]" id="groups" class="form-control" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create Player') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection