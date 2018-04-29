@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        	<h2 class="title-d">Scores</h2>
            <a class="create-d" href="{{ url('/scores/create') }}">
              <button class="btn btn-primary">
                <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
              </button>
            </a>

            @foreach($scores as $score)
                <p>{{ $score->arrow }} - {{ $score->score }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection