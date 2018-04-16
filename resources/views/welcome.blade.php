<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dart app with laravel - javascript and twitter bootstrap</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Dashboard</h2>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        <li><a href="{{ url('/groups') }}">groups</a></li>
                        <li><a href="{{ url('/players') }}">players</a></li>
                        <li><a href="{{ url('/games') }}">games</a></li>
                        <li><a href="{{ url('/scores') }}">scores</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endsection

    </body>
</html>
