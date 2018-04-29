@extends('layouts.app')

@section('header')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#table-d').DataTable({
        "paging"      : false,
        "info"        : false,
        "searching"   : false,
        "order"       : [[ 4, "desc" ]]
      });
    });
  </script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title-d">Players</h2>
            <a class="create-d" href="{{ url('/players/create') }}">
              <button class="btn btn-primary">
                <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
              </button>
            </a>

            <table class="table table-bordered" id="table-d">
              <thead>
                <tr>
                  <th scope="col">Id</th>
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
                      <td>{{ number_format(( ($player->won->count() / $player->games_count) * 100 ), 2) }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
@endsection