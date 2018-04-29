@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title-d">Games</h2>
            <!-- <a class="create-d" href="{{ url('/games/create') }}"> -->
            <a class="create-d" data-toggle="modal" data-target="#addModal" class="add-modal">
              <button class="btn btn-primary">
                <i class="fa fa-plus fa-1x" aria-hidden="true"></i>
              </button>
            </a>

            <div class="foreach-d">
                @foreach($games as $game)
                    <a href="{{ URL::to('/games/' . $game->id) }}">
                        <p>{{ $game->name }} - {{ $game->date }} - {{ $game->hour }}</p>
                    </a>
                @endforeach
            </div>
        </div>


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
                        <label for="players">{{ __('Players') }}</label>
                        <!-- <select id="players_add" class="form-control" multiple> -->
                        <select name="player_list[]" id="players_add" class="form-control" multiple>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->firstname }}</option>
                            @endforeach
                        </select>
                        <p class="errorPlayers text-center alert alert-danger hidden"></p>
                    </div>

                    <div class="form-group">
                        <label for="players">{{ __('Winner') }}</label>
                        <select id="winner_add" class="form-control">
                            @foreach($players as $player)
                                <option value="{{ $player->id }}">{{ $player->firstname }}</option>
                            @endforeach
                        </select>
                        <p class="errorWinner text-center alert alert-danger hidden"></p>
                    </div>
                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-success add" data-dismiss="modal">
                    <span id="" class='glyphicon glyphicon-check'></span> Add
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class='glyphicon glyphicon-remove'></span> Close
                </button>
              </div>

            </div>
          </div>
        </div>
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
                    'players': $('#players_add').val(),
                    'winner': $('#winner_add').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

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
                        if (data.errors.players) {
                            $('.errorPlayers').removeClass('hidden');
                            $('.errorPlayers').text(data.errors.players);
                        }
                        if (data.errors.winner) {
                            $('.errorWinner').removeClass('hidden');
                            $('.errorWinner').text(data.errors.winner);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.name + "</td><td>" + data.date + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        $('.new_published').iCheck({
                            checkboxClass: 'icheckbox_square-yellow',
                            radioClass: 'iradio_square-yellow',
                            increaseArea: '20%'
                        });
                        $('.new_published').on('ifToggled', function(event){
                            $(this).closest('tr').toggleClass('warning');
                        });
                        $('.new_published').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: "{{ URL::route('changeStatus') }}",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });
    </script>
    <!-- AJAX CRUD -->
@endsection
