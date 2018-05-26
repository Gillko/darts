@extends('layouts.app')

@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title-d">Games</h2>
            <a class="create-d" data-toggle="modal" data-target="#addModal" class="add-modal">
              <button class="btn btn-primary">
                <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
              </button>
            </a>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="gameTable">
                    <thead>
                        <tr>
                            <th><i class="fa fa-list-ol fa-1x"></i></th>
                            <th><i class="fa fa-hashtag fa-1x"></i></th>
                            <th><i class="fa fa-gamepad fa-1x"></i></th>
                            <th><i class="fa fa-calendar fa-1x"></i></th>
                            <th><i class="fa fa-clock-o fa-1x"></i></th>
                            <th><i class="fa fa-gamepad fa-1x"></i></th>
                            <th><i class="fa fa-users fa-1x"></i></th>
                            <th>
                                <i class="fa fa-trophy fa-1x"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $indexKey => $game)
                            <tr class="game{{$game->id}}">
                                <td class="col1">{{ $indexKey+1 }}</td>
                                <td>{{ $game->id }}</td>
                                <td>{{ $game->name }}</td>
                                <td>{{ $game->date }}</td>
                                <td>{{ $game->hour }}</td>
                                <td>{{ $game->type }}</td>
                                <td>
                                    @foreach ($game->players as $player)
                                        <p><a href="{{ URL::to('/players/' . $player->id) }}">{{ $player->firstname }} {{ $player->lastname }}</a></p>
                                    @endforeach
                                </td>
                                <td>{{ $game->player->nickname }}</td>
                                
                                <td>
                                    <button class="show-modal btn btn-primary" data-id="{{$game->id}}" data-name="{{$game->name}}">
                                        <span class="fa fa-eye fa-1x"></span>
                                    </button>
                                    <button class="edit-modal btn btn-primary" data-id="{{$game->id}}" data-name="{{$game->name}}">
                                        <span class="fa fa-edit fa-1x"></span>
                                    </button>
                                    <button class="delete-modal btn btn-primary" data-id="{{$game->id}}" data-name="{{$game->name}}">
                                        <span class="fa fa-trash-o fa-1x"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL FOR ADDING GAME -->
        <div class="modal fade" id="addModal">
          <div class="modal-dialog modal-dialog-d">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Create Game</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form method="POST" action="{{ route('games.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name_add" value="Adagio Game {{ $lastinsertid->id + 1 }}">
                        <p class="errorName text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="date">{{ __('Date') }}</label>
                        <input type="date" class="form-control" id="date_add" value="{{ date('Y-m-d') }}">
                        <p class="errorDate text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="hour">{{ __('Hour') }}</label>
                        <input type="text" class="form-control" id="hour_add" value="{{ date('H:i:s') }}">
                        <p class="errorHour text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="type">{{ __('Type') }}</label>
                        <input type="text" class="form-control" id="type_add"">
                        <p class="errorType text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="players">{{ __('Players') }}</label>
                        <select name="player_list[]" id="players_add" class="form-control" multiple>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}" id="{{ $player->nickname }}-player">{{ $player->nickname }}</option>
                            @endforeach
                        </select>
                        <p class="errorPlayers text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="players">{{ __('Winner') }}</label>
                        <select id="winner_add" class="form-control">
                            @foreach($players as $player)
                                <option value="{{ $player->id }}" id="{{ $player->nickname }}-winner">{{ $player->nickname }}</option>
                            @endforeach
                        </select>
                        <p class="errorWinner text-center alert alert-danger hidden"></p>
                    </div>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <!-- The add class is used for error messages -->
                <button type="button" class="btn btn-primary add" data-dismiss="modal">
                    <span class='fa fa-plus fa-1x'></span>
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <span class='fa fa-window-close-o fa-1x'></span>
                </button>
              </div>

            </div>
          </div>
        </div>
        <!-- MODAL FOR ADDING GAME -->

        <!-- MODAL FOR DELETING GAME -->
        <div class="modal fade" id="deleteModal">
          <div class="modal-dialog modal-dialog-d">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Are you sure you want to delete the following game?</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="id">{{ __('Id') }}</label>
                        <input type="text" class="form-control" id="id_delete" disabled>
                    </div>

                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name_delete" disabled>
                    </div>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-primary delete" data-dismiss="modal">
                    <span class='fa fa-trash-o fa-1x'></span>
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">
                    <span class='fa fa-window-close-o fa-1x'></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- MODAL FOR DELETING GAME -->
    </div>
</div>

@endsection

@section('footer')
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- JQUERY -->

    <!-- BOOTSTRAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- BOOTSTRAP -->

    <!-- TOASTR -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- TOASTR -->

    <!-- AJAX CRUD -->
    <script type="text/javascript">
        /* ADDING A GAME */
        $(document).on('click', '.add-modal', function() {
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'games',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': $('#name_add').val(),
                    'date': $('#date_add').val(),
                    'hour': $('#hour_add').val(),
                    'type': $('#type_add').val(),
                    'players': $('#players_add').val(),
                    'winner': $('#winner_add').val()
                },
                success: function(data) {
                    $('.errorName').addClass('hidden');
                    $('.errorDate').addClass('hidden');
                    $('.errorHour').addClass('hidden');
                    $('.errorType').addClass('hidden');
                    $('.errorPlayers').addClass('hidden');
                    $('.errorWinner').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.name) {
                            $('.errorName').removeClass('hidden');
                            $('.errorName').text(data.errors.name);
                        }
                        if (data.errors.date) {
                            $('.errorDate').removeClass('hidden');
                            $('.errorDate').text(data.errors.date);
                        }
                        if (data.errors.hour) {
                            $('.errorHour').removeClass('hidden');
                            $('.errorHour').text(data.errors.hour);
                        }
                        if (data.errors.type) {
                            $('.errorType').removeClass('hidden');
                            $('.errorType').text(data.errors.type);
                        }
                        if (data.errors.players) {
                            $('.errorPlayers').removeClass('hidden');
                            $('.errorPlayers').text(data.errors.players);
                        }
                        if (data.errors.winner) {
                            $('.errorWinner').removeClass('hidden');
                            $('.errorWinner').text(data.errors.winner);
                        }
                    } else {
                        toastr.success('Successfully added Game!', 'Success Alert', {timeOut: 5000});

                        $('#gameTable').prepend(
                            "<tr class='game" + data.id + "'>" 
                                + "<td class='col1'>" + data.id + "</td>"

                                + "<td>" + data.id + "</td>"

                                + "<td>" + data.name + "</td>"
                                
                                + "<td>" + data.date + "</td>"

                                + "<td>" + data.hour + "</td>"

                                + "<td>" + data.type + "</td>"

                                + "<td>" + data.players + "</td>" 

                                + "<td>" + data.winner + "</td>"
                                
                                + "<td>" 
                                    + "<button class='show-modal btn btn-primary' data-id='" + data.id + "' data-name='" + data.name + "'>"
                                        + "<span class='fa fa-eye fa-1x'>"
                                        + "</span>"
                                    + "</button>" 
                                    + "<button class='edit-modal btn btn-primary' data-id='" + data.id + "' data-name='" + data.name + "'>"
                                        + "<span class='fa fa-edit fa-1x'>"
                                        + "</span>"
                                    + "</button>" 
                                    + "<button class='delete-modal btn btn-primary' data-id='" + data.id + "' data-name='" + data.name + "'>"
                                        + "<span class='fa fa-trash-o fa-1x'>"
                                        + "</span>"
                                    + "</button>"
                                + "</td>"
                            + "</tr>"
                        );
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });
        /* ADDING A GAME */

        /* DELETING A GAME */
        $(document).on('click', '.delete-modal', function() {
            $('#id_delete').val($(this).data('id'));
            $('#name_delete').val($(this).data('name'));

            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'games/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted Game!', 'Success Alert', {timeOut: 5000});

                    /* every <tr> has a class with the name of game and index of the game */
                    /* this is used to live delete the game in the list of games */
                    $('.game' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });
        /* DELETING A GAME */

        /* POPULATING QUERY STRING VALUES INTO THE FORM */
        window.getQueryParams = function getQueryParams(qs) {  
            qs = qs.split('+').join(' ');
            var params = {},
            tokens,
            re = /[?&]?([^=]+)=([^&]*)/g;
            while (tokens = re.exec(qs)) {
                params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
            }  
            return params;
        }

        if (getQueryParams(location.search).game) {
            document.getElementById('type_add').value = getQueryParams(location.search).game;
        }

        if  (getQueryParams(location.search).players) {
             //document.getElementById('players_add').value = getQueryParams(location.search).players;

             //console.log( getQueryParams(location.search).players);


             var playerParams = getQueryParams(location.search).players;

             var values = playerParams.split(','),
             result = [];

             values.forEach(function(value) {
                var decodedValue = decodeURIComponent(value);
                result.push(decodedValue);
                //console.log(value);

                var playerSelect = document.getElementById(value + '-player');
                playerSelect.setAttribute('selected', 'selected');
            });

             
        }

        if  (getQueryParams(location.search).winner) {
            var queryparamWinner = getQueryParams(location.search).winner;
            var winnerSelect = document.getElementById(queryparamWinner + '-winner');
            winnerSelect.setAttribute('selected', 'selected');
        }
        /* POPULATING QUERY STRING VALUES INTO THE FORM */

        /* MULTIPLE SELECT SAME SIZE AS OPTIONS */
        var players = document.getElementById( 'players_add' );
        players.setAttribute( 'size', players.length );
        /* MULTIPLE SELECT SAME SIZE AS OPTIONS */
    </script>
    <!-- AJAX CRUD -->
@endsection
