@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Scores</h2>
            <a href="{{ url('/scores/create') }}"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>

            @foreach($scores as $score)
                <p>{{ $score->arrow }} - {{ $score->score }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection