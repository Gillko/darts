<!doctype html>
<html id="html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Darts</title>

        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <style>
        /*dart board*/
        svg{
            display: block;
            margin: 0 auto;
            padding: 20px 0 20px 0;
        }
        .red{
            color: #dc3545;
            fill: currentColor;
        }
        .green{
            color: #28a745;
            fill: currentColor;
        }
        .black{
            color: #000;
            fill: currentColor;
        }
        .beige{
            color: #f5f5dc;
            fill: currentColor;
        }
        .color-combination{
            color: #2d77b8;
            fill: currentColor;
        }
        .red:hover,
        .green:hover,
        .black:hover,
        .beige:hover,
        .color-combination:hover,
        .black:hover{
            opacity: 0.5;
            color: #2d77b8;
        }
        .score-value{
            padding-top: 5px;
            cursor: move;
        }
        .score-value:first-child{
            
        }
        .player:first-child{
            background-color: #28a745;
            color: #fff;
        }
        /*dart board*/
        .combination h1{
            text-align: center;
            padding-bottom: 20px;
            background-color: #000;
            opacity: 0.5;
            color: #fff;
        }
        .tripple-points,
        .double-points{
            text-align: right;
        }
        p{
            margin-bottom: 0rem;
        }
        h1,
        h2{
            padding: 15px 0 0 0;
        }
        #data-toggle-button,
        #data-toggle-button-undo,
        #button-start,
        #button-add-another-player,
        #data-toggle-show-log,
        #button-resume-game,
        #data-toggle-save-game{
            display: none;
        }
        a,
        a:hover{
            color: #fff;
        }
        #information-buttons{
            height: 50px;
            text-transform: uppercase;
            color: #495057;
            font-size: 16px;
            text-decoration: underline;
        }
        .points-player{
            font-size: 8px;
        }
        .show{
            visibility: visible;
            height: auto;
            padding-top: 20px;
        }
        .hide{
            visibility: hidden;
            height: 0px;
            margin-top: 0px;
        }
        .player{
            background-color: #f5f5dc;
            margin-bottom: 20px;
            cursor: move;
            border: solid 2px #;
        }
        .player:active,
        .player:hover{
            opacity: 0.5;
            background-color: #2d77b8;
            color: #fff;
        }
        #arrow-one-fill,
        #arrow-two-fill,
        #arrow-three-fill{
            visibility: hidden;
            margin-left: -29px;
        }
        #current-throw{
            font-size: 35px;
            color: #2d77b8;
            vertical-align: middle;
        }
        .disabled{
            pointer-events: none;
        }
        /*override bootstrap*/
        select,
        .form-control{
            border-radius: 0px;
        }
        .btn{
            border-radius: 0px;
        }
        .btn-primary{
            background-color: #2d77b8;
        }
        .form-control-points{
            font-size: 35px;
            background-color: transparent;
            border: 0px;
            text-align: center;
        }
        .form-control-points:disabled{
            background-color: transparent;
        }
        .btn-point{
            margin-bottom: 10px;
            margin-right: 3px;
        }
        .btn-point-number{
            width: 50px;
        }
        .form-control-points{
            text-align: right;
        }
    </style>
    <body id="body">
       <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand navbar-brand-d" href="{{ url('/') }}">
                Darts
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/leaderboard') }}">Leaderboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/groups') }}">Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/players') }}">Players</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/games') }}">Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/scores') }}">Scores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/leaderboard') }}">Leaderboard</a>
                    </li>
                    @endguest
                </ul>
                <span>
                    @guest
                    <a href="{{ route('login') }}">
                        <i class="fa fa-lock fa-1x" aria-hidden="true"></i>
                    </a>
                    @else
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item nav-item-user-name">
                            {{ Auth::user()->name }}
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-unlock fa-1x" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endguest
                </span>
            </div>
        </nav>
        <div class="container">
            <h1>Darts Scoreboard</h1>
            <form id="form">
                <div class="form-group">
                    <h2 id="amount-players">Game</h2>
                    <label for="games">Game</label>
                    <select class="form-control" id="game">
                        <option>501</option>
                        <option>401</option>
                        <option selected>301</option>
                        <option>201</option>
                        <option>101</option>
                    </select>
                </div>
                <div class="form-group">
                    <h2 id="amount-players">Players</h2>
                    <label for="players">Players</label>
                    <select multiple="multiple" class="form-control" id="players" size="14"></select>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" id="button-add-player" name="button" class="btn btn-block btn-primary">Add player</button>
                    </div>
                </div>
            </form>
            <br>
            <div class="row" id="button-start">
                <div class="col-md-12">
                    <button type="submit" id="button-start-game" name="button" class="btn btn-block btn-primary">Start game</button>
                    <button type="submit" id="button-resume-game" name="button" class="btn btn-block btn-primary">Resume game</button>
                    <button type="submit" id="button-add-another-player" name="button" class="btn btn-block btn-primary">Add another player</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div id="scoreboard">
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="overall-points-board">
                        <div class="row">
                            <div class="col-md-3 text-left">
                                <img src="{{ asset('img/arrow-no-fill.png') }}" alt="arrow no fill one" id="arrow-one-no-fill" width="25" height="25">
                                <img src="{{ asset('img/arrow-fill.png') }}" alt="arrow fill one" id="arrow-one-fill" width="25" height="25">
                            
                                <img src="{{ asset('img/arrow-no-fill.png') }}" alt="arrow no fill two" id="arrow-two-no-fill" width="25" height="25">
                                <img src="{{ asset('img/arrow-fill.png') }}" alt="arrow fill two" id="arrow-two-fill" width="25" height="25">
                            
                                <img src="{{ asset('img/arrow-no-fill.png') }}" alt="arrow no fill three" id="arrow-three-no-fill" width="25" height="25">
                                <img src="{{ asset('img/arrow-fill.png') }}" alt="arrow fill three" id="arrow-three-fill" width="25" height="25">
                                
                                <span id="current-throw">00</span>
                            </div>
                            <div class="col-md-9 text-right">
                                <button type="button" class="btn btn-primary btn-point button-undo" id="button-undo">
                                    <span class="fa fa-undo fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point" id="button-log">
                                    <span class="fa fa-list fa-1x"></span>
                                </button>
                                 <button type="button" class="btn btn-primary btn-point" id="button-delete-active-player">
                                    <span class="fa fa-minus fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point" id="next-player">
                                    <span class="fa fa-arrow-down fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point" id="previous-player">
                                    <span class="fa fa-arrow-up fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point" id="stop-game">
                                    <span class="fa fa-remove fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point" id="rematch">
                                    <span class="fa fa-gamepad fa-1x"></span>
                                </button>
                                <button type="button" class="btn btn-primary btn-point btn-save-game" id="save-game">
                                    <a id="save-game-link"><span class="fa fa-trophy fa-1x"></span></a>
                                </button>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 id="information-buttons"></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <svg id="svg" version="1.0" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1181.000000 1181.000000" preserveAspectRatio="xMidYMid meet"> 
                            <g transform="translate(0.000000,1181.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
                                <!--single 0--> 
                                <path id="single-0" class="black single-0" d="M5530 11799 c-2760 -183 -5015 -2233 -5454 -4960 -258 -1596 154 -3232 1138 -4519 1255 -1642 3284 -2511 5336 -2284 2749 303 4919 2472 5224 5224 167 1503 -257 3025 -1178 4230 -1123 1470 -2876 2331 -4721 2319 -121 -1 -276 -6 -345 -10z m266 -455 c50 -37 68 -70 67 -124 -1 -65 -26 -103 -151 -232 l-95 -98 126 0 127 0 0 -30 0 -30 -170 0 -170 0 0 33 c0 28 14 46 100 132 165 163 192 224 131 286 -25 25 -37 29 -83 29 -31 0 -71 -9 -97 -20 -24 -11 -45 -20 -47 -20 -4 0 -6 70 -1 70 1 0 20 7 42 15 59 22 185 16 221 -11z m480 5 c51 -31 85 -110 91 -214 13 -195 -57 -315 -182 -315 -123 0 -193 116 -183 305 7 126 46 207 113 235 40 17 126 11 161 -11z m1294 -414 l0 -234 58 -3 c54 -3 57 -4 60 -30 l3 -28 -158 0 -159 0 2 28 c1 26 3 27 57 30 l57 3 0 203 0 204 -60 -13 c-33 -7 -60 -12 -61 -11 -5 8 -3 59 3 62 15 10 94 22 146 23 l52 1 0 -235z m-3060 155 l0 -30 -110 0 -110 0 0 -62 0 -63 73 0 c63 0 79 -4 114 -27 55 -36 76 -84 71 -162 -4 -71 -30 -116 -81 -143 -41 -21 -160 -29 -214 -14 -40 11 -43 14 -43 46 l0 34 41 -14 c54 -19 132 -19 169 0 55 28 76 105 45 164 -28 56 -114 74 -212 45 l-23 -6 0 131 0 131 140 0 140 0 0 -30z m-1332 -677 c41 -20 73 -64 79 -112 9 -64 -25 -120 -143 -241 l-107 -110 126 0 127 0 0 -30 0 -30 -170 0 -170 0 0 32 c0 27 18 50 124 158 131 133 151 166 134 225 -4 17 -17 38 -29 48 -30 24 -121 22 -178 -3 -24 -11 -44 -20 -46 -20 -2 0 -3 16 -2 35 1 32 4 36 46 49 87 28 146 28 209 -1z m-508 -223 l0 -240 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 206 0 206 -22 -5 c-13 -4 -42 -9 -65 -13 -43 -7 -43 -6 -43 25 0 24 5 32 23 36 80 19 106 23 140 24 l37 1 0 -240z m3535 190 c298 -19 623 -71 880 -141 1290 -351 2355 -1243 2913 -2436 529 -1133 568 -2412 107 -3578 -358 -907 -1014 -1679 -1861 -2191 -876 -529 -1859 -735 -2909 -609 -1154 139 -2266 783 -2994 1734 -843 1102 -1129 2558 -766 3899 264 976 837 1823 1640 2426 865 650 1912 964 2990 896z m2633 -232 l2 -238 60 0 c60 0 60 0 60 -30 l0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 205 0 205 -22 -5 c-13 -3 -42 -9 -65 -14 l-43 -9 0 33 c0 33 1 34 63 48 34 8 78 14 97 14 l35 -2 3 -237z m519 225 c45 -21 73 -67 73 -118 -1 -48 -17 -80 -54 -104 l-27 -18 34 -21 c50 -29 74 -95 57 -157 -22 -80 -97 -122 -200 -112 -108 9 -160 59 -160 154 0 41 5 58 27 83 14 17 38 36 52 42 24 9 25 11 6 18 -36 14 -66 57 -72 100 -8 55 18 105 66 130 47 25 150 26 198 3z m-7479 -1077 c34 -18 64 -51 88 -96 15 -28 19 -57 19 -155 0 -104 -3 -125 -22 -160 -55 -103 -168 -150 -272 -114 -25 9 -31 16 -31 40 0 27 2 29 28 22 15 -5 53 -8 84 -8 46 0 61 4 83 25 35 32 51 64 60 119 l7 45 -31 -26 c-53 -45 -131 -48 -196 -8 -48 30 -69 75 -69 150 -1 78 26 130 82 160 44 23 131 26 170 6zm8432 -321 l0 -175 41 0 c38 0 40 -1 37 -27 -3 -24 -8 -28 -40 -31 l-38 -3 0 -60 0 -59 -37 0 -38 0 3 60 4 59 -124 3 -123 3 0 35 c0 28 23 70 110 203 l110 167 48 0 47 0 0 -175z m-9590 -1500 l0 -234 58 -3 c56 -3 57 -3 57 -33 l0 -30 -152 -2 -153 -1 0 35 0 34 58 -2 57 -3 3 203 2 204 -50 -7 c-28 -4 -57 -9 -65 -12 -12 -5 -15 2 -15 29 0 33 1 34 53 44 28 6 73 11 100 12 l47 1 0 -235z m540 60 l0 -175 35 0 c32 0 35 -2 35 -30 0 -28 -3 -30 -35 -30 l-34 0 -3 -62 -3 -63 -35 0 -35 0 -3 63 -3 62 -119 0 -120 0 0 34 c0 27 24 72 112 205 l111 171 49 0 48 0 0 -175z m10049 72 c45 -30 66 -80 57 -131 -6 -32 -46 -78 -76 -89 -11 -3 -8 -7 10 -15 71 -29 102 -129 62 -202 -39 -72 -147 -104 -264 -78 -63 13 -63 13 -66 50 l-3 37 33 -13 c80 -33 169 -28 218 12 13 10 23 33 27 58 5 36 1 46 -25 75 -27 30 -36 33 -96 37 -65 4 -66 5 -66 33 0 28 2 29 49 29 63 0 96 12 117 45 26 39 9 85 -40 109 -34 17 -47 18 -105 9 -36 -6 -74 -14 -83 -18 -15 -6 -18 -2 -18 23 0 36 5 40 62 52 74 16 164 6 207 -23z m-522 -217 l2 -235 56 -3 c54 -3 55 -4 55 -32 l0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 206 0 206 -22 -5 c-13 -4 -42 -9 -65 -13 -43 -7 -43 -6 -43 25 0 24 5 32 23 36 12 3 40 9 62 14 22 5 58 9 80 8 l40 -2 2 -235z m-10227 -1436 l0 -234 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 198 c0 109 -2 201 -5 204 -3 3 -33 0 -65 -7 l-60 -13 0 34 c0 31 2 33 53 43 58 12 128 18 140 13 4 -2 7 -109 7 -238z m470 0 l0 -234 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 198 c0 109 -2 201 -5 204 -3 3 -33 0 -65 -7 l-60 -13 0 34 c0 31 2 33 53 43 58 12 128 18 140 13 4 -2 7 -109 7 -238z m10150 235 c48 -10 50 -12 50 -45 0 -32 -1 -33 -26 -24 -14 6 -53 10 -86 10 -56 0 -63 -3 -93 -35 -21 -21 -37 -53 -45 -85 -14 -57 -9 -70 16 -45 24 24 59 35 107 35 110 0 182 -99 162 -222 -11 -63 -74 -124 -139 -133 -140 -21 -226 79 -226 265 0 107 22 172 74 225 59 58 116 73 206 54z m33 -1543 c83 -34 122 -133 115 -291 -7 -166 -55 -235 -168 -243 -99 -7 -156 42 -186 159 -42 163 12 343 116 382 28 10 91 7 123 -7z m-493 -231 l0 -234 58 -3 c54 -3 57 -4 60 -30 l3 -28 -155 0 -156 0 0 30 c0 30 1 30 55 30 l54 0 3 201 c2 110 2 202 0 204 -2 2 -18 -1 -35 -5 -91 -23 -87 -24 -87 14 0 32 2 34 48 44 26 5 71 10 100 11 l52 1 0 -235z m-9589 95 c107 -30 138 -160 55 -227 l-34 -26 32 -21 c92 -62 81 -210 -20 -252 -19 -8 -67 -14 -107 -14 -60 0 -80 4 -108 23 -90 60 -91 193 -2 244 l36 21 -30 15 c-32 17 -63 70 -63 106 0 101 119 165 241 131z m1022 -1436 c23 -5 27 -11 27 -39 l0 -33 -51 15 c-66 20 -114 10 -155 -31 -30 -30 -54 -87 -54 -129 0 -16 3 -16 30 4 73 54 203 25 244 -55 24 -47 25 -139 2 -184 -33 -64 -110 -100 -190 -88 -86 13 -138 82 -156 204 -11 80 1 175 30 232 22 43 81 98 113 104 12 3 31 7 42 10 20 4 64 1 118 -10z m-553 -234 l0 -240 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 c0 28 1 29 58 32 l57 3 0 200 c0 226 10 204 -82 189 -43 -6 -43 -6 -43 25 0 25 5 32 28 37 15 3 41 10 57 14 17 5 49 9 73 9 l42 1 0 -240z m8360 0 l0 -240 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 206 0 206 -22 -6 c-13 -3 -42 -9 -65 -12 -43 -7 -43 -6 -43 24 0 29 3 31 63 45 34 9 79 16 100 16 l37 1 0 -240z m558 208 l3 -28 -109 0 -110 0 -4 -64 -3 -64 77 -4 c85 -3 115 -19 156 -78 29 -43 31 -139 4 -190 -38 -70 -150 -104 -265 -80 -56 11 -57 12 -57 46 0 19 1 34 3 34 1 0 24 -7 51 -15 63 -19 96 -19 146 1 95 38 95 175 0 214 -30 13 -128 10 -162 -5 -17 -7 -18 3 -18 129 l0 137 143 -3 142 -3 3 -27z m-1481 -1114 c42 -31 73 -83 73 -121 0 -60 -29 -105 -142 -220 l-112 -113 127 0 127 0 0 -30 0 -30 -170 0 -170 0 0 26 c0 20 29 56 117 148 157 163 180 223 111 281 -35 29 -91 33 -153 9 -72 -28 -70 -28 -69 8 1 30 5 34 50 51 67 24 173 19 211 -9z m-5967 -81 c0 -10 -43 -129 -97 -265 l-96 -248 -39 0 c-22 0 -37 3 -35 8 6 10 177 452 177 458 0 2 -55 4 -123 4 -68 0 -126 2 -129 5 -3 3 -3 17 0 30 l4 25 169 0 c153 0 169 -2 169 -17z m4260 -843 l0 -240 60 0 60 0 0 -30 0 -30 -155 0 -155 0 0 30 0 30 60 0 60 0 0 206 0 207 -27 -6 c-16 -3 -45 -9 -66 -12 l-38 -7 3 33 c3 32 6 34 58 45 30 7 74 12 98 13 l42 1 0 -240z m589 218 c0 -13 -42 -131 -93 -263 l-93 -240 -36 -3 c-21 -2 -37 0 -37 5 0 5 40 111 89 236 l88 227 -128 0 -129 0 0 30 0 30 170 0 c170 0 170 0 169 -22z m-3156 -57 c24 -15 45 -41 64 -79 24 -50 28 -68 28 -157 0 -117 -13 -161 -63 -217 -49 -54 -80 -68 -156 -68 -90 0 -116 11 -116 51 0 26 3 30 18 24 9 -5 47 -10 83 -13 65 -4 68 -3 104 30 27 24 41 48 51 88 7 29 12 55 10 57 -2 2 -21 -8 -42 -22 -34 -23 -47 -26 -97 -23 -95 7 -148 61 -155 157 -7 96 36 166 117 192 42 13 116 4 154 -20z m-513 -222 l0 -240 58 2 57 3 0 -30 0 -29 -152 -3 -153 -3 0 33 0 33 55 -3 55 -4 0 207 0 208 -27 -6 c-105 -21 -98 -22 -97 15 1 32 3 33 55 44 30 7 75 12 102 13 l47 1 0 -241z m1795 0 c21 -6 54 -26 72 -44 28 -28 33 -40 33 -80 0 -56 -12 -80 -51 -104 l-29 -18 38 -24 c71 -46 81 -146 20 -214 -54 -62 -180 -81 -285 -44 -27 9 -33 16 -33 39 0 30 14 47 24 31 4 -5 31 -15 62 -21 134 -28 229 41 188 138 -16 39 -63 62 -129 62 -43 0 -45 1 -45 29 0 28 1 29 66 33 76 5 104 27 104 82 0 78 -111 107 -233 61 -14 -6 -17 -1 -17 28 0 35 1 36 53 45 73 13 116 14 162 1z M6151 11307 c-40 -20 -61 -60 -72 -133 -18 -121 11 -257 59 -283 65 -35 132 8 151 97 26 121 7 248 -44 299 -35 35 -56 40 -94 20z M9212 10325 c-57 -25 -68 -90 -23 -136 62 -61 170 -24 171 58 0 67 -79 109 -148 78z M9198 10084 c-57 -31 -66 -107 -19 -155 25 -25 37 -29 81 -29 44 0 56 4 81 29 65 65 20 171 -73 171 -24 -1 -55 -7 -70 -16z M1779 9253 c-57 -9 -95 -87 -78 -160 18 -82 112 -112 169 -55 38 39 47 90 25 148 -13 35 -25 49 -51 60 -18 8 -35 13 -36 13 -2 -1 -15 -4 -29 -6z M10216 9065 c-3 -9 -37 -65 -76 -125 -39 -60 -73 -117 -76 -125 -6 -14 5 -15 82 -13 l89 3 3 138 c2 124 -5 166 -22 122z M1089 7500 l-86 -135 85 -3 c46 -2 86 -1 89 1 2 2 2 65 1 138 l-3 134 -86 -135z M11022 5920 c-52 -48 -49 -157 5 -199 35 -29 94 -28 128 2 48 41 50 144 4 193 -30 32 -104 34 -137 4z M11097 4589 c-39 -23 -57 -87 -57 -202 0 -110 12 -160 47 -199 16 -18 75 -24 108 -12 32 13 58 84 63 175 9 155 -32 249 -106 249 -21 0 -45 -5 -55 -11z M999 4441 c-54 -43 -40 -129 26 -151 70 -23 135 15 135 81 0 54 -26 81 -86 86 -39 4 -54 1 -75 -16z M1031 4219 c-51 -11 -76 -41 -76 -93 0 -98 119 -142 191 -71 30 30 33 101 7 134 -22 27 -76 40 -122 30z M1965 2806 c-48 -48 -45 -147 6 -190 52 -44 134 -27 159 34 20 49 8 129 -24 157 -38 32 -108 32 -141 -1z M4607 1120 c-53 -42 -59 -143 -12 -194 36 -39 106 -37 146 3 24 25 29 37 29 81 0 56 -20 104 -49 120 -32 16 -86 12 -114 -10z"> 
                                    0 
                                </path>
                                
                                <!--double 20-->
                                <path id="double-20" class="red double double-20" d="M5585 10349 c-134 -11 -336 -37 -342 -43 -5 -4 23 -196 29 -201 2 -2 28 1 58 6 126 20 408 39 588 39 182 0 502 -21 602 -40 25 -5 48 -6 52 -2 10 11 33 191 25 198 -4 4 -78 16 -164 26 -185 22 -675 32 -848 17z"> 
                                    40 
                                </path> 

                                <!--double 5--> 
                                <path id="double-5" class="green double double-5" d="M5040 10270 c-268 -55 -500 -124 -760 -225 -134 -52 -370 -159 -370 -168 0 -8 92 -177 96 -177 3 0 35 15 72 34 272 137 673 270 1027 341 71 15 130 27 131 28 1 1 -6 46 -14 100 -12 75 -19 97 -31 96 -9 -1 -77 -13 -151 -29z">
                                    10
                                </path>

                                <!--double 1--> 
                                <path id="double-1" class="green double double-1" d="M6636 10283 c-9 -33 -28 -175 -23 -179 2 -3 71 -18 153 -35 332 -67 662 -176 978 -323 55 -25 100 -45 101 -44 7 8 85 169 85 175 0 5 -15 15 -32 22 -18 8 -73 34 -123 57 -227 105 -530 211 -785 272 -101 25 -328 72 -345 72 -2 0 -6 -8 -9 -17z">
                                    2
                                </path>

                                <!--top single 20-->
                                <path id="top-single-20" class="black single single-20" d="M5630 10114 c-19 -2 -106 -11 -192 -21 -145 -15 -158 -18 -158 -36 0 -19 6 -57 55 -362 13 -82 36 -224 50 -315 45 -290 108 -680 109 -680 1 0 55 7 121 15 149 19 460 19 615 1 63 -8 116 -13 118 -11 4 4 59 336 127 775 28 177 72 454 85 535 5 28 5 53 2 57 -4 3 -70 14 -147 23 -131 16 -689 30 -785 19z">
                                    20
                                </path>

                                <!--top single 5-->
                                <path id="top-single-5" class="beige single single-5" d="M5035 10026 c-280 -62 -571 -155 -790 -253 -55 -24 -126 -56 -157 -70 -62 -27 -75 -44 -52 -68 9 -8 13 -15 9 -15 -6 0 121 -251 463 -920 69 -135 129 -247 134 -248 4 -2 6 -8 3 -12 -3 -5 33 9 81 31 204 94 517 194 674 215 28 4 52 10 55 14 2 3 -23 175 -55 381 -33 206 -69 430 -80 499 -11 69 -31 196 -45 282 -14 86 -25 165 -25 175 0 29 -45 26 -215 -11z">
                                    5
                                </path>

                                 <!--top single 1-->
                                <path id="top-single-1" class="beige single single-20" d="M6600 10038 c-5 -13 -37 -198 -70 -413 -33 -214 -80 -510 -103 -657 -24 -147 -40 -265 -36 -262 4 2 9 1 11 -4 3 -8 203 -54 243 -56 11 -1 22 -3 25 -6 3 -3 52 -20 110 -39 115 -37 336 -124 388 -153 34 -19 58 -25 32 -8 -13 9 -13 10 0 10 16 0 319 580 303 580 -4 0 -3 4 3 8 16 10 84 148 77 156 -4 3 -1 6 6 6 7 0 19 17 27 38 9 20 61 126 116 236 55 109 95 195 89 192 -6 -4 -11 -3 -11 2 0 11 -155 85 -300 142 -237 95 -476 168 -718 220 -171 36 -180 36 -192 8z">
                                    1
                                </path>

                                <!--double 12-->
                                <path id="double-12" class="red double double-12" d="M3740 9793 c-319 -178 -605 -388 -903 -665 l-68 -63 75 -75 76 -74 57 55 c230 223 557 465 858 635 66 37 124 70 128 74 5 4 -14 48 -40 98 l-49 90 -134 -75z">
                                    24
                                </path>

                                <!--double 18-->
                                <path id="double-18" class="red double double-18" d="M7917 9771 l-47 -88 118 -66 c181 -100 332 -198 497 -322 145 -110 206 -161 372 -312 l80 -72 72 73 72 73 -93 89 c-222 211 -442 380 -729 556 -121 75 -272 158 -286 158 -5 0 -31 -40 -56 -89z">
                                    36
                                </path>

                                <!--top single 12-->
                                <path id="top-single-12" class="black single single-12" d="M3850 9583 c-301 -171 -598 -391 -848 -627 l-63 -60 492 -492 493 -493 66 62 c160 151 407 329 578 416 23 12 42 26 42 31 0 21 -620 1225 -632 1227 -7 1 -65 -28 -128 -64z">
                                    12
                                </path>

                                <!--top single 18-->
                                <path id="top-single-18" class="black single single-18" d="M7753 9446 c-57 -113 -103 -206 -103 -209 0 -2 -92 -185 -205 -405 -113 -221 -205 -406 -205 -411 0 -5 30 -26 68 -47 171 -95 371 -240 537 -389 l80 -72 495 488 495 489 -75 70 c-216 202 -479 404 -700 537 -140 84 -264 153 -276 153 -5 0 -55 -92 -111 -204z"> 
                                    18
                                </path>

                                <!--double 9-->
                                <path id="double-9" class="green double double-9" d="M2638 8921 c-187 -204 -348 -413 -491 -638 -77 -122 -197 -332 -197 -345 0 -4 40 -28 89 -53 l89 -44 61 109 c170 307 392 613 620 852 l85 89 -75 73 -74 73 -107 -116z"> 
                                    18
                                </path>

                                <!--double 4-->
                                <path id="double-4" class="green double double-4" d="M9026 8961 l-68 -69 107 -118 c130 -144 253 -298 359 -447 80 -115 227 -355 267 -439 13 -27 27 -48 31 -48 11 0 149 69 166 82 30 25 -243 467 -452 733 -117 149 -320 375 -336 375 -3 0 -36 -31 -74 -69z"> 
                                    8
                                </path> 

                                <!--top single 9-->
                                <path id="top-single-9" class="beige single single-9" d="M2897 8852 c-9 -10 -14 -22 -10 -26 5 -4 3 -6 -2 -4 -26 8 -406 -444 -397 -473 1 -5 -2 -9 -8 -9 -19 0 -233 -337 -224 -351 3 -5 1 -9 -5 -9 -8 0 -91 -140 -91 -155 0 -3 5 -3 10 0 6 3 10 2 10 -4 0 -11 520 -275 520 -264 0 4 4 3 8 -3 11 -18 104 -64 115 -57 6 3 7 2 4 -4 -6 -9 104 -68 119 -64 4 2 10 -2 13 -7 9 -14 291 -154 291 -145 0 5 4 3 8 -3 10 -15 96 -64 119 -69 16 -2 28 12 57 67 83 153 218 342 353 496 40 45 73 87 73 93 0 6 4 8 8 5 4 -2 9 5 10 18 1 16 -113 136 -481 504 -464 464 -484 482 -500 464z"> 
                                    9
                                </path>

                                <!--top single 4-->
                                <path id="top-single-4" class="beige single single-4" d="M8436 8371 l-487 -487 24 -22 c13 -12 27 -19 32 -15 4 5 5 3 2 -4 -4 -6 6 -23 23 -37 17 -14 32 -29 33 -33 1 -4 6 -7 10 -5 5 1 6 -1 3 -6 -3 -5 15 -30 39 -57 25 -27 45 -51 45 -55 0 -3 14 -20 30 -38 17 -18 30 -35 30 -36 0 -2 34 -54 75 -115 40 -62 91 -143 111 -181 21 -38 45 -71 53 -73 20 -4 162 64 155 75 -3 4 3 5 12 1 13 -5 15 -3 9 7 -5 8 -4 11 3 6 11 -7 92 31 92 43 0 4 6 8 14 8 18 0 179 83 188 97 4 6 8 7 8 3 0 -11 592 291 602 306 4 7 8 9 8 4 0 -11 102 43 118 62 8 9 10 10 6 2 -5 -9 -3 -12 5 -7 8 6 1 27 -25 74 -69 125 -146 252 -154 252 -3 0 -7 6 -7 13 0 54 -478 657 -552 697 -14 7 -104 -78 -505 -479z">
                                    4
                                </path>

                                <!--tripple 20-->
                                <path id="tripple-20" class="red tripple tripple-20" d="M5605 8685 c-55 -7 -101 -14 -103 -14 -2 -1 -1 -16 2 -33 3 -18 8 -51 11 -73 3 -22 8 -53 11 -68 l6 -28 86 8 c97 9 480 11 612 3 l84 -5 11 66 c6 36 11 81 11 100 l-1 34 -105 12 c-138 15 -499 14 -625 -2z">
                                    60
                                </path>

                                <!--tripple 5-->
                                <path id="tripple-5" class="green tripple tripple-5" d="M5320 8634 c-220 -50 -392 -108 -568 -190 l-94 -43 48 -90 47 -90 31 14 c279 123 372 154 656 218 l56 12 -15 98 c-16 113 -3 108 -161 71z"> 
                                    15
                                </path>

                                <!--tripple 1-->
                                <path id="tripple-1" class="green tripple tripple-1" d="M6376 8638 c-12 -53 -28 -170 -24 -173 2 -2 48 -13 103 -24 188 -39 441 -124 577 -192 33 -17 61 -29 63 -27 1 2 22 43 47 91 l46 88 -47 23 c-173 87 -521 199 -718 231 -39 6 -43 5 -47 -17z">
                                    3
                                </path>

                                <!--bottom single 20-->
                                <path id="bottom-single-20" class="black single single-20" d="M5760 8460 c-168 -12 -220 -20 -220 -37 0 -19 16 -124 45 -303 14 -80 27 -163 30 -185 5 -39 32 -211 80 -505 13 -80 27 -165 30 -190 3 -25 15 -94 25 -155 11 -60 22 -132 25 -160 3 -27 14 -99 25 -160 11 -60 24 -144 30 -185 6 -41 17 -114 26 -162 l16 -87 50 2 51 2 28 170 c52 317 79 480 84 520 5 39 29 188 80 495 14 85 27 173 30 195 2 22 16 110 30 195 85 516 87 530 72 530 -7 0 -48 4 -92 9 -116 14 -324 19 -445 11z">
                                    20
                                </path>

                                <!--bottom single 5-->
                                <path id="bottom-single-5" class="beige single single-5" d="M5450 8418 c-122 -23 -277 -66 -390 -106 -114 -41 -290 -116 -290 -124 0 -2 59 -118 130 -258 71 -140 185 -364 252 -497 67 -133 127 -239 132 -236 5 4 6 1 2 -5 -8 -14 30 -92 46 -92 6 0 8 -3 5 -7 -8 -7 299 -614 316 -625 7 -4 9 -8 4 -8 -9 0 62 -143 76 -151 13 -9 79 14 90 32 5 9 -30 253 -93 654 -56 352 -108 681 -116 730 -8 50 -34 216 -59 369 -25 154 -45 290 -45 302 0 30 -7 32 -60 22z">
                                    5
                                </path>

                                <!--bottom single 1-->
                                <path id="bottom-single-1" class="beige single single-1" d="M6340 8423 c0 -4 -18 -122 -41 -263 -80 -509 -120 -757 -134 -845 -8 -49 -44 -277 -80 -505 -36 -228 -68 -430 -72 -449 -4 -24 -2 -32 6 -27 6 4 11 3 11 -2 0 -9 23 -17 71 -27 11 -2 23 10 35 38 11 23 18 45 16 49 -1 5 2 8 7 8 10 0 21 27 20 44 0 5 4 12 9 15 13 8 132 247 126 255 -2 3 -1 4 3 1 8 -6 262 489 265 517 1 9 5 15 8 13 3 -2 72 127 153 286 82 159 145 289 140 289 -4 0 -3 4 3 8 19 13 75 123 68 134 -4 6 -3 8 3 5 10 -6 45 58 43 77 -1 5 3 12 8 15 5 3 24 34 41 69 l32 63 -73 33 c-156 72 -356 138 -533 177 -49 10 -100 21 -112 24 -13 3 -23 2 -23 -2z"> 
                                    1
                                </path>

                                <!--tripple 12-->
                                <path id="tripple-12" class="red tripple tripple-12" d="M4515 8326 c-187 -108 -419 -281 -530 -395 l-39 -41 69 -70 c38 -39 72 -70 75 -70 3 0 42 32 85 72 145 130 286 229 534 375 11 7 4 28 -33 101 -25 51 -47 92 -49 92 -1 0 -52 -29 -112 -64z"> 
                                    36
                                </path>

                                <!--tripple 18-->
                                <path id="tripple-18" class="red tripple tripple-18" d="M7175 8301 c-25 -50 -45 -93 -45 -95 0 -2 37 -26 83 -51 163 -94 355 -236 483 -357 l60 -57 74 74 c86 87 91 68 -58 196 -161 140 -307 242 -494 348 l-57 32 -46 -90z">
                                    54
                                </path>

                                <!--bottom single 12-->
                                <path id="bottom-single-12" class="black single single-12" d="M4619 8112 c-168 -100 -284 -187 -467 -349 l-43 -38 754 -753 754 -754 41 29 c23 15 41 31 42 35 0 3 -92 186 -203 405 -112 219 -288 565 -392 768 -299 590 -366 715 -378 715 -7 -1 -55 -26 -108 -58z"> 
                                    12
                                </path>

                                <!--bottom single 18-->
                                <path id="bottom-single-18" class="black single single-18" d="M7098 8157 c-2 -7 -131 -262 -288 -567 -156 -305 -371 -724 -476 -930 l-193 -375 37 -32 c20 -18 42 -32 47 -33 6 0 347 337 760 750 l749 749 -29 32 c-95 100 -330 277 -490 368 -93 53 -111 59 -117 38z"> 
                                    18
                                </path>

                                <!--double 14-->
                                <path id="double-14" class="red double double-14" d="M1875 7798 c-111 -240 -201 -483 -265 -717 -39 -141 -100 -422 -100 -460 0 -16 14 -21 98 -34 53 -8 100 -13 103 -11 3 2 9 27 13 56 9 78 70 333 117 488 53 178 126 372 206 548 36 78 64 144 62 146 -9 8 -169 86 -177 86 -5 0 -31 -46 -57 -102z">
                                    28
                                </path>
                                
                                <!--double 13-->
                                <path id="double-13" class="red double double-13" d="M9826 7854 c-68 -35 -87 -49 -83 -62 3 -9 37 -87 75 -172 129 -289 221 -577 284 -890 17 -85 32 -157 34 -159 5 -6 188 21 197 29 11 9 -45 288 -93 463 -52 190 -128 409 -202 581 -55 129 -115 257 -121 255 -1 0 -42 -20 -91 -45z">
                                    26
                                </path>
                                
                                <!--tripple 9-->
                                <path id="tripple-9" class="green double tripple-9" d="M3843 7783 c-142 -158 -277 -346 -381 -531 l-41 -72 89 -45 c49 -25 92 -45 94 -45 2 0 23 35 47 78 80 146 180 286 322 451 l89 103 -68 69 c-38 38 -71 69 -75 69 -3 0 -38 -35 -76 -77z">
                                    27
                                </path>
                                
                                <!--tripple 4-->
                                <path id="tripple-4" class="green tripple tripple-4" d="M7852 7787 l-72 -73 46 -44 c109 -107 298 -365 374 -513 19 -37 38 -67 43 -67 7 0 167 78 176 86 15 14 -183 324 -301 471 -62 77 -184 213 -191 213 -2 0 -35 -33 -75 -73z">
                                    12
                                </path>
                                
                                <!--single 14-->
                                <path id="top-single-14" class="black single single-14" d="M2093 7702 c-106 -228 -201 -485 -263 -717 -41 -151 -91 -408 -82 -416 4 -3 102 -20 217 -38 116 -18 275 -43 355 -56 80 -13 222 -36 315 -50 94 -15 236 -37 316 -51 81 -13 151 -24 156 -24 5 0 17 43 27 96 36 193 116 440 202 623 24 52 43 95 42 97 -2 1 -221 113 -488 249 -267 136 -545 278 -618 316 l-133 68 -46 -97z">
                                    14
                                </path>
                                
                                <!--single 13-->
                                <path id="top-single-13" class="black single single-13" d="M9090 7480 c-333 -170 -609 -311 -615 -313 -5 -2 11 -48 36 -103 83 -177 150 -381 194 -589 14 -65 28 -121 30 -124 3 -2 53 4 112 13 179 28 349 54 523 81 168 26 377 59 599 95 68 11 126 22 129 25 18 18 -82 440 -157 665 -69 205 -220 561 -238 559 -4 0 -280 -139 -613 -309z">
                                    13
                                </path>
                                
                                <!--single 4-->
                                <path id="bottom-single-4" class="beige single single-4" d="M7537 7471 c-122 -121 -237 -234 -254 -251 -18 -16 -33 -35 -33 -40 0 -6 -4 -10 -10 -10 -14 0 -150 -135 -150 -149 0 -7 -4 -10 -8 -7 -11 6 -145 -128 -137 -137 3 -4 2 -5 -2 -2 -10 7 -63 -46 -57 -57 3 -5 0 -7 -8 -6 -7 2 -12 -3 -10 -10 1 -8 -2 -11 -7 -8 -11 7 -33 -19 -23 -28 4 -4 0 -6 -8 -4 -8 2 -14 -3 -13 -9 2 -7 -2 -12 -9 -10 -7 1 -12 -4 -13 -10 0 -7 -3 -12 -7 -10 -5 1 -127 -117 -273 -263 -226 -226 -263 -266 -252 -280 7 -8 18 -27 25 -42 11 -27 32 -38 32 -18 0 6 3 9 8 8 16 -4 52 14 46 24 -4 6 -2 8 4 5 14 -9 43 3 36 14 -3 5 1 6 9 3 15 -6 227 100 239 120 4 6 8 8 8 3 0 -10 103 42 112 57 4 6 8 8 8 3 0 -9 162 72 171 85 3 5 10 9 15 8 18 -3 143 64 137 73 -3 6 -1 7 5 3 13 -8 103 34 96 46 -3 4 2 5 10 2 8 -3 23 3 33 13 11 11 25 17 31 15 7 -2 15 3 18 12 3 9 10 13 15 10 5 -3 9 -1 9 5 0 6 7 8 15 5 8 -4 17 1 21 10 3 9 10 14 14 11 5 -3 14 0 22 7 7 7 20 14 28 16 8 2 17 8 18 13 2 5 8 7 13 3 5 -3 9 0 9 7 0 7 3 10 6 6 7 -7 86 30 95 45 3 5 10 8 14 7 14 -5 384 185 378 195 -3 5 -1 6 6 2 12 -8 120 47 133 68 4 6 8 8 8 3 0 -4 23 4 51 18 l50 26 -37 67 c-84 152 -248 384 -280 396 -9 3 -13 10 -10 15 3 5 -10 23 -29 40 -20 17 -33 31 -29 31 4 0 -3 11 -16 25 -12 13 -27 22 -33 18 -6 -3 -7 -1 -3 5 3 6 2 14 -4 17 -6 4 -110 -91 -233 -214z">
                                    4
                                </path>
                                
                                <!--single 9-->
                                <path id="bottom-single-9" class="beige single single-9" d="M4037 7642 c-20 -21 -37 -40 -37 -43 0 -3 -22 -28 -48 -56 -95 -101 -316 -440 -306 -468 5 -13 85 -53 93 -47 2 2 7 0 10 -5 12 -18 83 -53 93 -47 6 4 8 3 5 -3 -8 -12 81 -56 96 -47 7 4 9 3 4 -1 -7 -8 687 -368 711 -368 6 0 12 -4 12 -8 0 -8 28 -19 44 -18 5 0 12 -4 15 -9 9 -13 91 -54 91 -45 0 5 4 3 8 -2 14 -21 102 -66 114 -59 6 4 8 3 5 -3 -6 -9 260 -147 277 -143 5 1 12 -2 15 -8 3 -5 68 -41 144 -80 l139 -71 33 36 c24 27 31 41 25 52 -18 33 -1476 1481 -1491 1481 -8 0 -32 -17 -52 -38z">
                                    9
                                </path>
                                
                                <!--tripple 14-->
                                <path id="tripple-14" class="red tripple tripple-14" d="M3365 7068 c-86 -189 -147 -370 -189 -564 -15 -65 -28 -127 -30 -136 -2 -10 -3 -18 -3 -18 17 -5 203 -37 204 -36 2 1 12 46 23 100 39 188 125 447 197 589 13 27 23 50 21 52 -7 6 -175 95 -180 95 -3 0 -22 -37 -43 -82z">
                                    42
                                </path>
                                
                                <!--tripple 13-->
                                <path id="tripple-13" class="red tripple tripple-13" d="M8355 7105 c-44 -25 -84 -46 -90 -48 -5 -2 7 -39 27 -83 79 -175 152 -398 184 -569 10 -49 18 -91 19 -93 1 -1 22 2 46 7 24 5 69 12 98 15 30 4 57 8 59 10 7 8 -38 214 -73 335 -36 128 -109 320 -156 414 -16 31 -30 57 -32 56 -1 0 -38 -20 -82 -44z">
                                    39
                                </path>
                                
                                <!--single 14-->
                                <path id="bottom-single-14" class="black single single-14" d="M3565 6933 c-83 -189 -197 -577 -181 -618 2 -7 32 -16 68 -20 35 -4 126 -17 203 -30 77 -13 217 -35 310 -50 94 -14 235 -37 315 -51 80 -13 177 -28 215 -33 39 -5 124 -18 190 -29 66 -11 197 -32 290 -47 94 -15 235 -38 315 -51 200 -33 193 -34 208 23 7 25 9 49 5 53 -14 12 -1875 960 -1885 960 -3 0 -27 -48 -53 -107z">
                                    14
                                </path>
                                
                                <!--single 13-->
                                <path id="bottom-single-13" class="black single single-13" d="M8205 7032 c-10 -9 -507 -262 -1435 -730 -245 -123 -446 -225 -447 -226 -7 -6 34 -96 43 -96 6 0 72 9 145 21 74 11 166 25 204 30 39 5 122 18 185 28 63 11 192 31 285 46 94 14 238 37 320 50 83 13 227 35 320 50 94 15 238 37 320 50 83 13 187 29 233 36 45 6 84 14 86 18 7 12 -63 298 -99 406 -44 130 -126 317 -140 322 -6 2 -15 -1 -20 -5z">
                                    13
                                </path>
                                
                                <!--double 11-->
                                <path id="double-11" class="green double double-11" d="M1500 6563 c0 -4 -9 -87 -20 -183 -27 -233 -35 -534 -21 -745 11 -163 38 -416 46 -423 3 -3 136 14 181 23 20 4 20 6 8 85 -39 244 -44 832 -10 1070 23 159 28 146 -56 160 -40 6 -85 13 -100 16 -16 3 -28 2 -28 -3z">
                                    22
                                </path>
                                
                                <!--double 6-->
                                <path id="double-6" class="green double double-6" d="M10220 6546 c-65 -10 -75 -14 -73 -31 1 -11 10 -92 20 -180 33 -292 22 -781 -23 -1063 l-6 -39 98 -16 c54 -9 99 -15 101 -13 6 6 33 227 43 355 22 290 4 785 -36 979 -5 25 -10 25 -124 8z">
                                    12
                                </path>
                                
                                <!--single 11-->
                                <path id="top-single-11" class="beige single single-11" d="M1736 6503 c-18 -86 -37 -316 -43 -508 -6 -229 5 -459 33 -635 8 -52 15 -100 16 -106 1 -6 8 -10 17 -8 17 4 867 138 1141 180 91 14 172 28 180 31 8 3 19 5 23 4 5 -1 6 6 3 16 -35 118 -35 703 0 824 2 9 -1 16 -8 17 -7 0 -40 5 -73 11 -33 6 -215 36 -405 65 -190 30 -460 73 -600 95 -141 23 -261 41 -267 41 -6 0 -14 -12 -17 -27z">
                                    11
                                </path>
                                
                                <!--single 6-->
                                <path id="top-single-6" class="beige single single-6" d="M10095 6520 c3 -5 0 -7 -8 -4 -8 3 -46 1 -83 -5 -79 -11 -759 -118 -999 -156 -88 -15 -183 -29 -212 -32 l-51 -6 4 -51 c3 -28 9 -98 14 -156 13 -137 13 -308 -1 -445 -20 -216 -20 -215 1 -215 17 0 575 -88 1178 -185 85 -14 157 -23 162 -20 8 5 24 120 40 300 13 141 13 559 0 695 -17 187 -32 290 -42 290 -5 0 -6 -4 -3 -10z">
                                    6
                                </path>
                                
                                <!--tripple 11-->
                                <path id="tripple-11" class="green tripple tripple-11" d="M3137 6273 c-18 -109 -29 -325 -24 -473 5 -143 22 -318 32 -328 2 -2 45 3 96 10 l94 13 -1 30 c0 17 -6 104 -13 195 -11 156 -4 399 15 521 l6 37 -68 11 c-38 7 -83 14 -100 17 -30 5 -31 4 -37 -33z">
                                    33
                                </path>
                                
                                <!--tripple 6-->
                                <path id="tripple-6" class="green tripple tripple-6" d="M8592 6292 c-92 -15 -93 -16 -87 -41 33 -162 33 -541 -1 -727 l-6 -30 102 -15 c117 -17 103 -32 120 123 21 201 4 698 -25 703 -5 1 -52 -5 -103 -13z">
                                    18
                                </path>
                                
                                <!--bull 25-->
                                <path id="bull-25" class="green bull bull-25" d="M5795 6283 c-171 -62 -274 -195 -283 -368 -12 -223 133 -403 348 -434 184 -25 351 62 432 226 43 88 51 206 19 300 -44 129 -127 224 -230 264 -78 31 -218 36 -286 12z m211 -218 c81 -40 121 -114 112 -207 -12 -118 -147 -198 -262 -154 -73 28 -136 114 -136 187 0 36 33 108 64 138 65 63 143 75 222 36z">
                                    25
                                </path>
                                
                                <!--bull\s eye 50-->
                                <path id="bulls-eye-50" class="red bulls-eye bulls-eye-50" d="M5842 6033 c-106 -52 -112 -221 -11 -282 65 -40 156 -34 200 12 38 39 62 105 55 151 -8 47 -45 100 -86 121 -38 20 -116 19 -158 -2z">
                                    50
                                </path>
                                
                                <!--single 11-->
                                <path id="bottom-single-11" class="beige single single-11" d="M3362 6158 c-21 -207 -8 -638 20 -638 5 0 6 -5 2 -11 -4 -7 0 -9 12 -5 11 3 64 12 119 20 55 9 271 43 480 76 209 33 421 67 470 75 50 7 234 36 410 64 176 28 381 61 456 73 l135 21 3 45 c1 25 5 50 8 55 3 6 1 7 -5 3 -5 -3 -12 -2 -14 2 -1 5 -52 16 -113 25 -60 9 -366 57 -680 107 -313 50 -640 102 -725 115 -85 14 -227 36 -315 50 -88 14 -181 28 -206 32 l-46 5 -11 -114z">
                                    11
                                </path>
                                
                                <!--single 6-->
                                <path id="bottom-single-6" class="beige single single-6" d="M8290 6245 c-136 -23 -328 -53 -630 -100 -91 -14 -221 -34 -290 -45 -260 -41 -521 -81 -680 -105 -91 -14 -201 -31 -245 -38 l-80 -13 1 -54 c2 -50 4 -55 25 -58 13 -1 78 -11 144 -22 66 -11 246 -40 400 -65 154 -25 310 -50 346 -56 36 -5 70 -9 75 -8 5 1 16 -1 24 -4 17 -7 312 -54 375 -61 22 -2 47 -6 55 -9 8 -3 148 -27 310 -52 162 -26 307 -49 321 -52 l26 -5 11 104 c20 187 23 291 13 442 -15 209 -19 226 -45 225 -11 -1 -82 -11 -156 -24z">
                                    6
                                </path>
                                
                                <!--single 8-->
                                <path id="bottom-single-8" class="black single single-8" d="M5395 5788 c-33 -5 -130 -20 -215 -34 -85 -13 -227 -36 -315 -50 -88 -13 -227 -36 -310 -49 -82 -14 -168 -27 -190 -30 -22 -3 -109 -16 -192 -30 -84 -14 -222 -36 -305 -49 -84 -14 -229 -37 -321 -52 l-168 -27 7 -41 c14 -88 65 -276 103 -387 46 -134 120 -299 133 -299 5 0 433 216 952 480 l942 480 -15 50 c-10 32 -21 49 -31 49 -8 -1 -42 -6 -75 -11z">
                                    8
                                </path>
                                
                                <!--single 10-->
                                <path id="bottom-single-10" class="black single single-10" d="M6342 5753 c-7 -25 -9 -49 -5 -53 9 -8 141 -76 1128 -580 380 -194 705 -361 724 -372 18 -10 35 -18 36 -16 7 7 79 168 101 228 60 155 134 424 134 486 0 22 15 19 -435 90 -88 14 -239 38 -335 54 -96 16 -263 43 -370 60 -107 17 -247 40 -310 51 -64 10 -149 23 -190 29 -41 5 -154 23 -250 40 -96 16 -184 30 -195 30 -16 0 -24 -10 -33 -47z">
                                    10
                                </path>
                                
                                <!--single 16-->
                                <path id="bottom-single-16" class="beige single single-16" d="M5378 5594 c-82 -41 -148 -79 -148 -86 0 -6 -3 -8 -6 -5 -9 9 -604 -293 -604 -306 0 -6 -3 -7 -7 -4 -3 4 -207 -95 -452 -220 -542 -276 -505 -256 -513 -267 -9 -13 23 -76 35 -69 6 3 7 1 3 -6 -4 -6 2 -24 13 -40 12 -16 21 -34 21 -41 0 -6 5 -8 12 -4 6 4 8 3 5 -3 -4 -6 21 -50 54 -99 115 -168 269 -344 302 -344 7 0 6 -4 -3 -10 -8 -5 -10 -10 -4 -10 16 0 55 45 47 54 -5 4 -1 6 7 4 8 -2 14 3 12 10 -1 8 1 11 6 8 12 -7 54 38 45 49 -5 4 -3 5 3 2 14 -8 127 106 117 118 -5 4 -3 5 3 2 14 -8 57 36 47 47 -5 4 -1 6 7 4 8 -1 14 2 13 9 -1 6 4 17 12 23 8 7 15 9 15 5 0 -5 9 0 20 10 11 10 17 22 14 27 -3 4 0 7 8 6 7 -2 12 3 10 10 -1 8 2 11 6 8 12 -7 44 28 35 39 -5 4 -3 5 3 2 10 -6 92 69 87 78 -2 3 0 5 3 4 13 -2 93 85 87 95 -3 6 -2 8 2 3 11 -9 66 43 59 55 -3 5 0 7 8 6 7 -2 12 3 11 9 -2 7 2 12 9 10 7 -1 12 5 13 13 0 8 5 15 10 15 18 0 36 16 29 26 -3 5 0 8 8 7 7 -2 12 3 11 9 -2 7 3 12 10 10 6 -1 11 4 9 11 -1 8 2 11 7 8 11 -7 33 19 23 28 -4 4 0 6 8 4 8 -2 14 4 15 12 0 8 7 15 15 15 8 1 14 6 13 12 -1 6 7 19 17 28 11 10 20 15 20 10 0 -4 7 -2 15 5 8 7 12 16 9 21 -3 5 0 8 8 7 7 -2 12 3 10 10 -1 6 4 11 10 10 7 -2 12 3 10 10 -1 6 4 11 10 10 7 -2 12 3 10 10 -1 6 4 11 10 10 7 -2 12 3 10 10 -1 6 3 11 10 10 7 -2 12 3 13 10 0 6 3 11 6 10 11 -5 39 24 33 33 -3 5 0 8 8 7 7 -2 12 3 10 10 -1 6 4 11 10 10 7 -2 12 4 10 12 -2 8 0 12 4 7 10 -9 65 43 58 55 -3 5 0 7 8 6 7 -2 12 3 10 10 -1 6 4 11 10 10 7 -2 12 3 11 10 -2 6 2 11 9 10 7 -2 12 2 13 9 0 15 13 28 28 28 7 1 11 6 10 13 -2 7 3 11 10 10 6 -2 11 3 10 10 -2 6 3 11 10 10 6 -2 11 3 10 10 -2 6 3 11 10 10 6 -2 11 4 9 12 -2 8 0 12 4 8 10 -11 35 12 27 25 -3 5 -1 7 4 4 13 -8 36 17 25 27 -4 4 0 6 8 4 8 -1 14 3 13 10 -2 6 2 11 9 10 7 -2 12 4 13 12 0 8 7 15 15 15 8 1 14 6 13 13 -2 7 3 11 10 10 6 -2 11 3 9 10 -1 8 2 11 7 8 23 -15 18 15 -10 58 -17 25 -32 46 -32 45 -1 0 -68 -34 -149 -75z">
                                    16
                                </path>
                                
                                <!--single 15-->
                                <path id="bottom-single-15" class="beige single single-15" d="M6282 5625 l-30 -43 431 -430 c238 -236 466 -465 508 -508 41 -44 94 -95 117 -114 23 -19 42 -41 42 -48 0 -7 5 -10 10 -7 6 3 10 0 10 -8 0 -8 8 -21 17 -28 14 -12 16 -12 9 1 -4 8 -1 7 7 -3 9 -10 24 -25 34 -34 10 -8 11 -11 3 -7 -13 7 -13 5 -1 -9 7 -9 17 -14 22 -11 5 3 9 -2 9 -11 0 -10 5 -13 12 -9 6 4 8 3 5 -3 -4 -6 0 -16 8 -23 8 -7 15 -9 16 -4 0 5 4 -1 10 -14 5 -13 13 -21 17 -18 9 5 77 -59 77 -72 0 -4 3 -6 6 -5 8 3 75 -67 72 -75 -2 -4 0 -7 5 -7 14 0 32 -16 27 -25 -3 -4 3 -14 11 -21 15 -12 24 -6 76 51 70 78 230 282 229 293 -1 4 8 16 18 26 24 24 131 205 136 230 3 15 -43 42 -258 151 -144 73 -266 136 -272 140 -5 4 -190 98 -410 210 -220 112 -404 206 -410 210 -11 8 -439 225 -496 251 l-37 17 -30 -43z">
                                    15
                                </path>
                                
                                <!--single 7-->
                                <path id="bottom-single-7" class="black single single-7" d="M4861 4806 l-753 -753 93 -83 c154 -136 308 -246 460 -329 l76 -41 368 722 c202 398 420 824 483 947 l115 224 -39 33 c-21 18 -41 33 -44 34 -3 0 -344 -339 -759 -754z">
                                    7
                                </path>
                                
                                <!--single 2-->
                                <path id="bottom-single-2" class="black single single-2" d="M6185 5529 c-22 -17 -40 -33 -40 -37 1 -7 129 -264 200 -397 23 -44 200 -393 394 -775 193 -382 355 -701 360 -708 6 -10 31 0 107 44 168 96 329 215 457 335 l68 64 -753 752 -753 752 -40 -30z">
                                    2
                                </path>
                                
                                <!--single 19-->
                                <path id="bottom-single-19" class="beige single single-19" d="M5669 5358 c-109 -216 -338 -667 -446 -876 -57 -111 -101 -208 -97 -214 4 -6 3 -9 -2 -5 -12 7 -347 -650 -338 -664 4 -8 3 -9 -4 -5 -7 4 -12 3 -12 -1 0 -17 315 -147 331 -137 5 3 9 1 9 -4 0 -9 136 -51 180 -56 14 -1 30 -5 35 -8 19 -11 164 -40 173 -34 5 3 12 27 15 53 3 26 22 147 41 268 130 815 156 990 152 1002 -3 7 -2 13 3 13 4 0 13 37 20 83 7 45 32 207 57 360 24 154 43 286 42 295 -2 13 -74 52 -95 52 -1 0 -29 -55 -64 -122z">
                                    19
                                </path>
                                
                                <!--single 17-->
                                <path id="bottom-single-17" class="beige single single-17" d="M6060 5462 c-25 -8 -46 -16 -48 -17 -2 -1 6 -60 18 -131 37 -232 108 -689 235 -1509 37 -236 69 -436 71 -443 3 -9 15 -11 41 -6 59 10 303 73 316 81 7 4 20 9 30 10 54 9 347 132 347 146 0 5 -4 6 -9 3 -5 -3 -8 1 -7 9 1 17 -567 1144 -575 1139 -3 -2 -6 2 -6 9 0 18 -194 401 -207 409 -6 4 -8 8 -3 8 8 0 -140 297 -151 304 -4 2 -27 -3 -52 -12z">
                                    17
                                </path>
                                
                                <!--tripple 8-->
                                <path id="tripple-8" class="red tripple tripple-8" d="M3221 5444 c-40 -7 -75 -14 -76 -16 -6 -6 44 -227 75 -333 43 -147 156 -430 185 -463 3 -4 185 86 185 92 0 2 -20 47 -45 100 -57 122 -137 360 -164 491 -12 55 -23 110 -26 123 -6 26 -22 27 -134 6z">
                                    24
                                </path>
                                
                                <!--tripple 10-->
                                <path id="tripple-10" class="red tripple tripple-10" d="M8485 5418 c-27 -175 -129 -487 -211 -650 l-24 -46 93 -50 92 -50 29 56 c45 88 113 264 151 389 33 111 89 352 82 359 -2 2 -37 8 -78 14 -41 5 -86 13 -101 16 -24 5 -26 2 -33 -38z">
                                    30
                                </path>
                                
                                <!--single 3-->
                                <path id="bottom-single-3" class="black single single-3" d="M5855 5357 c-8 -49 -20 -121 -25 -160 -5 -40 -18 -121 -29 -182 -11 -60 -23 -132 -26 -160 -3 -27 -14 -99 -25 -160 -10 -60 -21 -130 -25 -155 -5 -43 -22 -149 -80 -500 -14 -85 -27 -172 -30 -193 -2 -20 -16 -103 -30 -185 -15 -81 -28 -160 -30 -177 -1 -16 -6 -55 -10 -86 l-7 -56 39 -6 c98 -16 339 -28 443 -22 116 6 272 23 279 30 4 5 -10 109 -44 315 -13 80 -35 222 -50 315 -14 94 -37 238 -50 320 -32 204 -68 435 -101 645 -15 96 -39 249 -54 339 l-27 163 -51 2 -50 1 -17 -88z">
                                    3
                                </path>
                                
                                <!--single 8-->
                                <path id="top-single-8" class="black single single-8" d="M3055 5418 c-147 -23 -321 -51 -495 -78 -525 -82 -813 -129 -817 -134 -5 -5 48 -258 78 -380 58 -228 157 -503 264 -731 l55 -117 347 177 c192 98 470 240 620 317 l271 139 -49 109 c-86 192 -169 456 -199 633 -7 37 -15 69 -19 70 -3 2 -28 0 -56 -5z">
                                    8
                                </path>
                                
                                <!--single 10-->
                                <path id="top-single-10" class="black single single-10" d="M8726 5408 c-2 -7 -13 -60 -25 -118 -42 -199 -125 -445 -209 -617 l-30 -63 121 -64 c276 -144 1106 -566 1114 -566 23 0 201 429 267 640 56 182 147 574 135 584 -2 1 -110 19 -239 40 -129 20 -316 50 -415 66 -428 70 -683 110 -699 110 -9 0 -18 -6 -20 -12z">
                                    10
                                </path>
                                
                                <!--double 8-->
                                <path id="double-8" class="red double double-8" d="M1608 5191 c-87 -13 -98 -17 -98 -36 0 -39 60 -311 100 -457 70 -254 181 -551 281 -751 l40 -78 89 47 c50 26 90 51 90 54 0 4 -26 63 -59 131 -95 202 -196 482 -256 715 -32 123 -75 329 -75 359 0 13 -3 25 -7 27 -5 2 -52 -3 -105 -11z">
                                    16
                                </path>
                                
                                <!--double 10-->
                                <path id="double-10" class="red double double-10" d="M10124 5163 c-62 -358 -189 -761 -344 -1090 -27 -58 -50 -107 -50 -109 0 -5 167 -94 177 -94 25 0 193 401 276 655 69 213 165 629 148 640 -6 3 -178 35 -193 35 -4 0 -10 -17 -14 -37z">
                                    20
                                </path>
                                
                                <!--tripple 16-->
                                <path id="tripple-16" class="green tripple tripple-16" d="M3513 4641 l-91 -46 60 -105 c109 -189 220 -341 358 -491 l81 -88 69 70 c39 39 70 73 70 76 0 2 -30 37 -66 76 -100 110 -236 294 -317 431 l-72 123 -92 -46z">
                                    48
                                </path>
                                
                                <!--tripple 15-->
                                <path id="tripple-15" class="green tripple tripple-15" d="M8190 4604 c-86 -157 -258 -391 -364 -494 -25 -24 -46 -49 -46 -55 0 -6 31 -41 68 -78 l69 -68 63 65 c135 140 310 380 399 546 l40 76 -84 42 c-47 23 -89 42 -94 42 -5 0 -28 -34 -51 -76z">
                                    45
                                </path>
                                
                                <!--single 16-->
                                <path id="top-single-16" class="beige single single-16" d="M3302 4537 c-46 -24 -79 -47 -75 -51 4 -5 2 -6 -4 -2 -13 7 -73 -22 -73 -36 0 -4 -3 -7 -7 -6 -15 4 -53 -14 -53 -24 0 -6 -3 -8 -7 -5 -6 7 -923 -453 -923 -463 0 -3 34 -66 76 -140 98 -174 255 -410 268 -403 5 3 6 2 3 -4 -7 -12 153 -220 239 -310 35 -36 64 -70 64 -75 0 -5 6 -6 13 -2 6 4 9 3 4 -1 -8 -10 81 -105 98 -105 5 0 3 5 -5 10 -12 8 -11 10 7 10 12 0 25 5 29 12 5 7 3 8 -6 3 -9 -5 -11 -4 -6 4 4 6 11 9 16 6 4 -3 14 3 21 12 12 14 12 16 -1 8 -13 -8 -13 -6 -1 8 7 9 17 14 22 11 5 -3 8 -1 7 4 -2 6 1 10 5 10 14 0 67 54 62 62 -3 4 3 14 12 21 14 12 16 12 8 -1 -8 -13 -6 -13 8 -1 9 7 15 17 12 21 -3 4 3 14 13 21 16 13 16 13 2 -6 -14 -19 -14 -19 3 -6 9 7 17 20 17 27 0 8 6 13 13 11 6 -1 11 4 10 10 -2 7 2 12 9 10 7 -1 12 3 13 10 0 15 13 28 28 28 7 1 11 6 10 13 -2 7 3 11 10 9 6 -1 11 4 10 10 -2 7 2 12 9 10 7 -1 12 3 13 10 0 7 6 18 14 25 12 11 13 10 6 -2 -8 -13 -6 -13 8 -1 9 7 14 17 11 22 -3 5 0 8 8 7 7 -2 12 3 11 9 -2 7 3 12 10 10 6 -1 11 3 10 9 -1 6 15 26 35 45 l37 34 -35 -40 -35 -40 38 34 c20 19 37 40 37 47 0 6 8 18 18 25 16 13 16 13 2 -6 -14 -20 -14 -20 7 -1 13 10 20 23 17 28 -3 4 0 7 8 6 7 -2 12 3 11 9 -2 7 2 12 9 10 7 -1 12 3 13 10 0 15 13 28 28 28 7 1 11 6 10 12 -1 6 5 17 15 25 16 12 16 11 2 -7 -14 -20 -14 -20 7 -1 13 10 21 22 18 26 -5 8 43 56 53 53 4 0 6 3 5 8 -2 5 3 8 10 6 6 -1 11 4 10 11 -2 6 3 12 10 12 18 0 59 45 50 54 -5 4 -1 6 7 4 8 -2 14 3 13 10 -2 6 4 12 13 12 9 0 12 5 8 13 -4 6 -3 9 1 4 5 -4 35 18 66 49 l58 57 -72 81 c-40 44 -86 95 -104 114 -18 18 -31 34 -31 35 3 4 -115 162 -130 175 -9 6 -13 12 -10 12 3 0 -30 59 -73 131 -44 73 -79 136 -79 140 0 14 -10 11 -98 -34z">
                                    16
                                </path>
                                
                                <!--single 15-->
                                <path id="top-single-15" class="beige single single-15" d="M8444 4568 c-5 -7 -2 -8 7 -4 8 4 7 2 -2 -6 -9 -7 -48 -67 -88 -133 -39 -66 -103 -162 -141 -212 -38 -51 -66 -93 -62 -93 4 0 -1 -5 -11 -11 -9 -6 -14 -15 -11 -21 4 -6 3 -8 -3 -5 -11 7 -49 -41 -45 -56 1 -4 -2 -6 -7 -5 -12 4 -101 -98 -93 -107 4 -5 2 -5 -4 -2 -6 4 -19 -2 -28 -11 -15 -17 -13 -21 22 -53 l37 -34 -35 40 -35 40 37 -34 c20 -19 36 -39 35 -45 -1 -5 5 -10 13 -11 8 0 15 -7 15 -15 0 -8 7 -15 15 -15 8 0 15 -5 15 -12 0 -15 13 -28 28 -28 7 0 12 -7 12 -15 0 -8 5 -15 10 -15 16 0 36 -16 30 -24 -2 -5 7 -19 20 -31 14 -13 25 -20 25 -15 0 4 9 0 20 -10 11 -10 17 -21 15 -25 -5 -8 25 -38 40 -39 6 -1 10 -7 10 -13 1 -7 7 -12 14 -10 7 1 10 -1 7 -6 -7 -12 48 -64 58 -55 4 5 6 1 4 -7 -2 -8 3 -14 10 -15 6 0 12 -4 13 -10 1 -18 31 -45 43 -38 6 3 8 2 3 -2 -10 -12 33 -56 47 -48 6 3 7 2 3 -2 -10 -12 133 -156 147 -148 6 3 7 2 3 -2 -10 -11 153 -176 166 -168 6 3 7 2 4 -4 -3 -5 21 -36 53 -68 33 -33 60 -54 60 -47 0 7 4 11 8 8 10 -6 75 58 67 66 -3 3 3 11 12 19 17 13 17 13 3 -6 -14 -20 -14 -20 7 -1 13 10 20 23 17 28 -3 4 0 7 7 6 7 -2 13 2 14 9 0 6 14 23 30 37 17 14 30 30 30 35 0 5 4 13 9 18 5 5 6 2 1 -6 -5 -9 -4 -12 3 -7 7 4 12 12 12 18 0 5 11 19 26 30 14 11 23 23 20 25 -3 3 6 14 19 25 14 11 25 25 25 33 0 7 7 16 16 19 8 3 12 11 8 17 -4 7 -3 9 3 6 11 -7 28 20 24 36 -1 5 3 6 9 2 5 -3 10 -2 10 4 0 5 13 24 29 42 17 19 27 38 23 47 -3 9 -1 13 5 9 11 -7 60 61 55 76 -1 5 2 6 8 2 9 -6 14 8 11 28 -1 5 3 6 9 2 10 -6 15 9 10 30 -1 5 2 7 6 3 10 -10 66 81 58 94 -4 6 -2 8 4 4 9 -6 45 52 136 218 15 27 24 52 19 56 -15 14 -317 163 -330 163 -6 0 -10 3 -8 6 2 4 -105 61 -238 129 -133 67 -333 169 -444 226 -127 65 -205 100 -209 94z">
                                    15
                                </path>
                                
                                <!--tripple 7-->
                                <path id="tripple-7" class="red tripple tripple-7" d="M4016 3961 c-38 -38 -67 -73 -65 -79 13 -33 255 -232 405 -333 86 -58 258 -159 270 -159 5 0 96 182 92 184 -2 1 -54 33 -117 70 -168 100 -279 181 -432 318 -42 37 -78 68 -81 68 -2 0 -34 -31 -72 -69z">
                                    21
                                </path>
                                
                                <!--tripple 2-->
                                <path id="tripple-2" class="red tripple tripple-2" d="M7675 3964 c-101 -95 -291 -235 -430 -317 -66 -39 -121 -72 -123 -73 -5 -3 87 -184 93 -184 9 0 163 89 234 135 157 101 441 332 441 359 0 11 -130 147 -140 146 -3 -1 -36 -30 -75 -66z">
                                    6
                                </path>
                                
                                <!--double 16-->
                                <path id="double-16" class="green double double-16" d="M2035 3888 c-44 -22 -82 -42 -84 -44 -6 -6 99 -195 185 -332 147 -236 318 -458 519 -675 l89 -97 72 71 73 72 -56 61 c-281 310 -476 578 -650 890 -27 50 -54 91 -59 92 -5 2 -45 -15 -89 -38z">
                                    32
                                </path>
                                
                                <!--double 15-->
                                <path id="double-15" class="green double double-15" d="M9664 3842 c-150 -279 -371 -585 -609 -845 l-108 -119 71 -71 71 -71 32 29 c124 117 408 471 538 670 71 110 231 384 231 397 0 4 -40 28 -89 53 l-89 44 -48 -87z">
                                    30
                                </path>
                                
                                <!--single 7-->
                                <path id="top-single-7" class="black single single-7" d="M3427 3372 l-488 -488 90 -86 c184 -175 421 -358 640 -495 99 -62 314 -184 317 -180 11 16 624 1227 624 1233 0 5 -31 26 -70 47 -165 90 -374 240 -530 381 -46 42 -86 76 -89 76 -3 0 -226 -220 -494 -488z">
                                    7
                                </path>
                                
                                <!--single 2-->
                                <path id="top-single-2" class="black single single-2" d="M7825 3778 c-125 -113 -296 -239 -449 -330 -71 -43 -133 -78 -137 -78 -5 0 -9 -5 -9 -11 0 -6 140 -288 311 -625 l310 -614 42 21 c299 151 631 389 930 663 l82 76 -490 490 c-269 270 -492 490 -495 490 -3 -1 -45 -37 -95 -82z">
                                    2
                                </path>
                                
                                <!--tripple 19-->
                                <path id="tripple-19" class="green tripple tripple-19" d="M4709 3471 c-24 -47 -45 -89 -47 -92 -5 -11 229 -110 377 -159 127 -41 323 -91 401 -102 23 -3 25 0 41 95 11 70 13 100 5 102 -6 2 -66 15 -133 29 -146 32 -376 109 -506 169 l-94 44 -44 -86z">
                                    57
                                </path>
                                
                                <!--tripple 17-->
                                <path id="tripple-17" class="green tripple tripple-17" d="M7000 3517 c-162 -77 -463 -171 -613 -192 -38 -6 -47 -11 -43 -24 3 -9 10 -53 17 -98 10 -67 16 -83 30 -83 62 0 350 75 497 129 68 26 292 121 292 125 0 0 -22 42 -48 92 l-47 91 -85 -40z">
                                    51
                                </path>
                                
                                <!--single 19-->
                                <path id="top-single-19" class="beige single single-19" d="M4444 2953 c-108 -214 -248 -487 -310 -608 -62 -121 -110 -225 -106 -231 9 -15 92 -57 92 -47 0 5 4 2 9 -5 22 -36 501 -212 741 -272 164 -42 363 -80 371 -72 3 4 22 113 42 242 20 129 68 433 107 674 38 242 68 441 67 442 -1 2 -50 13 -107 24 -207 43 -471 131 -634 211 -32 16 -62 29 -66 29 -5 0 -97 -174 -206 -387z">
                                    19
                                </path>
                                
                                <!--single 17-->
                                <path id="top-single-17" class="beige single single-17" d="M7135 3316 c-123 -57 -199 -88 -328 -130 -76 -25 -145 -46 -153 -46 -8 0 -14 -5 -14 -11 0 -5 -4 -8 -9 -4 -9 5 -187 -29 -221 -42 -8 -4 -18 -5 -22 -5 -10 3 -10 0 7 -98 8 -47 35 -215 59 -375 128 -824 135 -868 149 -877 9 -6 8 -8 -2 -8 -8 0 -12 -2 -10 -4 7 -8 248 41 409 82 231 60 635 206 623 225 -3 6 -1 7 5 3 10 -6 89 27 102 43 3 3 14 7 25 9 11 2 28 13 38 25 10 12 16 16 12 10 -3 -7 -1 -13 4 -13 6 0 11 2 11 5 0 11 -33 70 -42 76 -5 3 -9 10 -9 15 1 16 -10 44 -18 44 -4 0 -8 6 -8 13 0 17 -543 1087 -551 1087 -4 -1 -29 -11 -57 -24z">
                                    17
                                </path>
                                
                                <!--tripple 3-->
                                <path id="tripple-3" class="red tripple tripple-3" d="M5526 3279 c-3 -19 -10 -65 -16 -103 -6 -37 -10 -69 -8 -71 12 -10 269 -25 426 -25 183 0 389 15 404 28 7 7 -17 190 -26 199 -2 2 -48 0 -103 -6 -183 -20 -434 -19 -615 4 l-57 7 -5 -33z">
                                    9
                                </path>
                                
                                <!--single 3-->
                                <path id="top-single-3" class="black single single-3" d="M5475 2967 c-9 -61 -27 -177 -40 -257 -25 -155 -59 -365 -99 -625 -14 -88 -33 -208 -42 -268 -9 -59 -15 -109 -13 -112 9 -9 263 -35 439 -45 102 -6 250 -8 330 -4 140 6 500 40 508 49 2 2 -5 61 -17 132 -11 70 -32 201 -46 291 -14 89 -36 233 -50 320 -22 140 -49 315 -86 555 -12 77 -12 78 -38 73 -161 -34 -656 -34 -807 -1 -20 4 -22 -2 -39 -108z">
                                    3
                                </path>
                                
                                <!--double 7-->
                                <path id="double-7" class="red double double-7" d="M2842 2787 l-73 -74 103 -95 c299 -275 568 -470 917 -662 65 -36 87 -44 93 -34 5 7 27 49 50 93 32 63 38 81 27 88 -8 4 -63 35 -122 67 -279 154 -602 391 -833 613 -45 42 -83 77 -85 77 -3 0 -37 -33 -77 -73z">
                                    14
                                </path>
                                
                                <!--double 2-->
                                <path id="double-2" class="red double double-2" d="M8910 2852 c0 -11 -211 -200 -323 -289 -190 -152 -458 -330 -644 -428 -40 -20 -73 -42 -73 -48 0 -10 89 -177 94 -177 5 0 190 101 251 138 114 68 351 231 455 313 182 143 390 332 390 354 0 12 -131 145 -143 145 -4 0 -7 -4 -7 -8z">
                                    4
                                </path>
                                
                                <!--double 19-->
                                <path id="double-19" class="green double double-19" d="M3954 1988 c-25 -49 -44 -91 -42 -93 2 -2 67 -33 145 -68 320 -147 655 -255 1012 -326 57 -12 111 -21 120 -21 14 0 20 16 30 83 7 45 14 89 17 98 3 12 -15 19 -93 33 -346 65 -719 185 -1031 332 l-112 53 -46 -91z">
                                    38
                                </path>
                                
                                <!--double 17-->
                                <path id="double-17" class="green double double-17" d="M7725 2025 c-308 -146 -699 -271 -1027 -330 l-98 -17 7 -42 c3 -22 10 -51 14 -64 5 -13 9 -33 9 -45 0 -46 11 -50 91 -37 207 35 583 142 824 235 92 36 373 159 381 168 2 2 -18 43 -44 93 l-47 91 -110 -52z">
                                    34
                                </path>
                                
                                <!--double 3-->
                                <path id="double-3" class="red double double-3" d="M6440 1657 c-170 -29 -809 -31 -1018 -3 -79 10 -146 16 -149 12 -9 -8 -35 -187 -29 -193 10 -11 176 -32 340 -44 199 -15 681 -6 856 15 172 21 168 20 163 53 -7 48 -36 168 -42 174 -3 3 -58 -3 -121 -14z">
                                    6
                                </path>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <button id="data-toggle-button-undo" type="button" data-toggle="modal" data-target="#modal-error-undo"></button>
            <div id="modal-error-undo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">You can't undo!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>You don't have points yet.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <button id="data-toggle-show-log" type="button" data-toggle="modal" data-target="#modal-show-log"></button>
            <div id="modal-show-log" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">You don't have any points yet!</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>You need to throw an arrow first.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <button id="data-toggle-save-game" type="button" data-toggle="modal" data-target="#modal-save-game"></button>
            <div id="modal-save-game" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Congratulations</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p><span id="winner-name-modal"></span> has won the game!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-point btn-save-game" id="save-game">
                                <a id="save-game-link-two">Save Game</a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $players = \App\Player::all();
            $optionsPlayers = [];
            foreach ($players as $player) {
                array_push($optionsPlayers, $player->nickname);
            }
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            $( function() {
                $( "#scoreboard" ).sortable({
                    cancel: null 
                });
                $( "#scoreboard" ).disableSelection();
            });

            var stopGame = document.getElementById('stop-game');

            stopGame.onclick = function(){
                window.localStorage.clear();
                location.reload();
            }

            document.getElementById('button-undo').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'undo';
            }

            document.getElementById('button-undo').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('button-log').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'show log';
            }

            document.getElementById('button-log').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('button-delete-active-player').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'delete active player';
            }

            document.getElementById('button-delete-active-player').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('next-player').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'next player';
            }

            document.getElementById('next-player').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('previous-player').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'previous player';
            }

            document.getElementById('previous-player').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('stop-game').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'stop game';
            }

            document.getElementById('stop-game').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('rematch').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'rematch';
            }

            document.getElementById('rematch').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            document.getElementById('save-game').onmouseover = function(){
                document.getElementById('information-buttons').innerHTML = 'save game';
            }

            document.getElementById('save-game').onmouseout = function(){
                document.getElementById('information-buttons').innerHTML = '';
            }

            //---Variables
            var i;
            var selectList = document.getElementById( 'players' ) ;

            var optionsPlayers =    <?php 
                                        echo '
                                                ["' 
                                                . 
                                                    implode(
                                                        '", "', $optionsPlayers
                                                )
                                                .
                                                '"];'
                                    ; ?>

            //console.log(optionsPlayers);

            //---Sort alphabetically
            optionsPlayers.sort(function( a, b ){

                if( a < b ) return -1 ;
                if( a > b ) return 1 ;
                return 0 ;
            })

            //---For loop to append every player to an option
            for(i = 0; i < optionsPlayers.length; i++) {

                //---Variables
                var optionPlayer    = optionsPlayers[ i ] ;
                var option          = document.createElement( 'option' ) ;

                option.textContent  = optionPlayer ;
                option.value        = optionPlayer ;

                selectList.appendChild( option ) ;
            }

            //---Add a player to the game
            document.getElementById( 'button-add-player' ).onclick = function() {

                //---Variables
                var players = document.getElementById( 'players' );

                console.log( getSelectValues( players ) );
                players.remove( players.selectedIndex );

                //---Prevent deletion of newly added player
                return false;
            }

            //---Variables
            var form                                    = document.getElementById( 'form' );
            var amountPlayers                           = document.getElementById( 'amount-players' );
            var buttonStartGame                         = document.getElementById( 'button-start-game' );
            var buttonResumeGame                        = document.getElementById( 'button-resume-game' );
            var buttonAddAnotherPlayer                  = document.getElementById( 'button-add-another-player' );
            var rematch                                 = document.getElementById('rematch');

            //---Start the game
            document.getElementById( 'button-start-game' ).onclick = function() {

                form.style.display                      = 'none';
                amountPlayers.style.display             = 'none';
                buttonStartGame.style.display           = 'none';
                buttonResumeGame.style.display          = 'none';
                buttonAddAnotherPlayer.style.display    = 'block';

                var gameType;

                gameType = document.getElementById('score-value').value;
                localStorage.setItem('gameType', gameType);

                var scoreboard; 

                scoreboard = document.getElementById('scoreboard').innerHTML;
                localStorage.setItem('scoreboard', scoreboard);

                return false;
            }

            //---Resume the game after adding new player
            document.getElementById( 'button-resume-game' ).onclick = function() {

                form.style.display                      = 'none';
                amountPlayers.style.display             = 'none';
                buttonStartGame.style.display           = 'none';
                buttonResumeGame.style.display          = 'none';
                buttonAddAnotherPlayer.style.display    = 'block';

                var scoreboard; 

                scoreboard = document.getElementById('scoreboard').innerHTML;
                localStorage.setItem('scoreboard', scoreboard);

                return false;
            }

            //---When refreshing page the DOM isn't deleted because we stored it in localstorage
            var currentScoreboard = localStorage.getItem('scoreboard');
            document.getElementById('scoreboard').innerHTML = currentScoreboard;

            //---Add another player
            document.getElementById( 'button-add-another-player' ).onclick = function() {

                form.style.display                      = 'block';
                amountPlayers.style.display             = 'none';
                buttonStartGame.style.display           = 'none';
                buttonResumeGame.style.display          = 'block';
                buttonAddAnotherPlayer.style.display    = 'none';

                return false;
            }

            //---multiple select same size as options
            var playersSelect = document.getElementById( 'players' );
            playersSelect.setAttribute( 'size', playersSelect.length );

            var playersArray = [ ];

            function getSelectValues( select ) {

                //---Variables
                var i;
                var options = select && select.options;
                var option;
                var typeOfGame = document.getElementById('game').value;

                for (i = 0, ilenght = options.length; i < ilenght; i++) {
                    option = options[i];

                    if (option.selected) {
                        playersArray.push(option.value);

                        localStorage.setItem('players', JSON.stringify(playersArray));

                        //---Variables
                        var scoreboard = document.getElementById('scoreboard');

                        scoreboard = document.createElement('div');
                        scoreboard.className = 'col-md-12 col-12 player';
                        scoreboard.id = 'player';
                        scoreboard.innerHTML = 
                                        '<div class="row points-player hide" id="points-player">' 
                                            + '<div class="col-md-4 col-4 points-name" id="points-name">'
                                            + '</div>' 
                                            + '<div class="col-md-4 col-4 points-minus-log" id="points-minus-log">'
                                            + '</div>'
                                            + '<div class="col-md-4 col-4 points-after-third-arrow" id="points-after-third-arrow">'
                                            + '</div>'
                                        + '</div>' 
                                        + '<div class="board">' 
                                            + '<div class="row">' 
                                                + '<div class="col-md-6 col-sm-6 col-6">' 
                                                    + '<h2 class="player-name" id="player-name">' + option.value + '</h2>'
                                                + '</div>'
                                                + '<div class="col-md-6 col-sm-6 col-6" id="point-input">'
                                                    + '<input class="form-control form-control-points score-value" id="score-value" value="' + typeOfGame + '" disabled/>'
                                                + '</div>'
                                            + '</div>'
                                            + '<div class="combination" id="combination">' 
                                            + '</div>'
                                        + '</div>'
                                    + '</div>'
                                + '<div>'
                            + '</div>'
                        
                        document.getElementById( 'button-delete-active-player' ).onclick = function() {
                            document.getElementById( 'player' ).outerHTML = "";
                        }

                        document.getElementById('scoreboard').appendChild(scoreboard);

                        var scoreTripple20Name = 'tripple-20';
                        var scoreTripple19Name = 'tripple-19';
                        var scoreTripple18Name = 'tripple-18';
                        var scoreTripple17Name = 'tripple-17';
                        var scoreTripple16Name = 'tripple-16';
                        var scoreTripple15Name = 'tripple-15';
                        var scoreTripple14Name = 'tripple-14';
                        var scoreTripple13Name = 'tripple-13';
                        var scoreTripple12Name = 'tripple-12';
                        var scoreTripple11Name = 'tripple-11';
                        var scoreTripple10Name = 'tripple-10';
                        var scoreTripple9Name = 'tripple-9';
                        var scoreTripple8Name = 'tripple-8';
                        var scoreTripple7Name = 'tripple-7';
                        var scoreTripple6Name = 'tripple-6';
                        var scoreTripple5Name = 'tripple-5';
                        var scoreTripple4Name = 'tripple-4';
                        var scoreTripple3Name = 'tripple-3';
                        var scoreTripple2Name = 'tripple-2';
                        var scoreTripple1Name = 'tripple-1';

                        var scoreDouble20Name = 'double-20';
                        var scoreDouble19Name = 'double-19';
                        var scoreDouble18Name = 'double-18';
                        var scoreDouble17Name = 'double-17';
                        var scoreDouble16Name = 'double-16';
                        var scoreDouble15Name = 'double-15';
                        var scoreDouble14Name = 'double-14';
                        var scoreDouble13Name = 'double-13';
                        var scoreDouble12Name = 'double-12';
                        var scoreDouble11Name = 'double-11';
                        var scoreDouble10Name = 'double-10';
                        var scoreDouble9Name = 'double-9';
                        var scoreDouble8Name = 'double-8';
                        var scoreDouble7Name = 'double-7';
                        var scoreDouble6Name = 'double-6';
                        var scoreDouble5Name = 'double-5';
                        var scoreDouble4Name = 'double-4';
                        var scoreDouble3Name = 'double-3';
                        var scoreDouble2Name = 'double-2';
                        var scoreDouble1Name = 'double-1';

                        var scoreTopSingle20Name = 'top-single-20';
                        var scoreTopSingle19Name = 'top-single-19';
                        var scoreTopSingle18Name = 'top-single-18';
                        var scoreTopSingle17Name = 'top-single-17';
                        var scoreTopSingle16Name = 'top-single-16';
                        var scoreTopSingle15Name = 'top-single-15';
                        var scoreTopSingle14Name = 'top-single-14';
                        var scoreTopSingle13Name = 'top-single-13';
                        var scoreTopSingle12Name = 'top-single-12';
                        var scoreTopSingle11Name = 'top-single-11';
                        var scoreTopSingle10Name = 'top-single-10';
                        var scoreTopSingle9Name = 'top-single-9';
                        var scoreTopSingle8Name = 'top-single-8';
                        var scoreTopSingle7Name = 'top-single-7';
                        var scoreTopSingle6Name = 'top-single-6';
                        var scoreTopSingle5Name = 'top-single-5';
                        var scoreTopSingle4Name = 'top-single-4';
                        var scoreTopSingle3Name = 'top-single-3';
                        var scoreTopSingle2Name = 'top-single-2';
                        var scoreTopSingle1Name = 'top-single-1';
                        var scoreSingle0Name = 'single-0';

                        var scoreBottomSingle20Name = 'bottom-single-20';
                        var scoreBottomSingle19Name = 'bottom-single-19';
                        var scoreBottomSingle18Name = 'bottom-single-18';
                        var scoreBottomSingle17Name = 'bottom-single-17';
                        var scoreBottomSingle16Name = 'bottom-single-16';
                        var scoreBottomSingle15Name = 'bottom-single-15';
                        var scoreBottomSingle14Name = 'bottom-single-14';
                        var scoreBottomSingle13Name = 'bottom-single-13';
                        var scoreBottomSingle12Name = 'bottom-single-12';
                        var scoreBottomSingle11Name = 'bottom-single-11';
                        var scoreBottomSingle10Name = 'bottom-single-10';
                        var scoreBottomSingle9Name = 'bottom-single-9';
                        var scoreBottomSingle8Name = 'bottom-single-8';
                        var scoreBottomSingle7Name = 'bottom-single-7';
                        var scoreBottomSingle6Name = 'bottom-single-6';
                        var scoreBottomSingle5Name = 'bottom-single-5';
                        var scoreBottomSingle4Name = 'bottom-single-4';
                        var scoreBottomSingle3Name = 'bottom-single-3';
                        var scoreBottomSingle2Name = 'bottom-single-2';
                        var scoreBottomSingle1Name = 'bottom-single-1';

                        var scoreBull25Name = 'bull-25';
                        var scoreBullsEye50Name = 'bulls-eye-50';

                        var buttonLog = document.getElementById('button-log');

                        if (buttonLog === null ){
                            console.log('buttonLog does not exist');
                        } else{
                            buttonLog.onclick = function() {
                                if(document.getElementById('points-name').innerHTML != ''){
                                    var showhide = document.getElementById('points-player');
                                    if (showhide.classList.contains('hide')) {
                                        showhide.classList.remove('hide');
                                        showhide.classList.add('show');
                                    } else{
                                        showhide.classList.remove('show');
                                        showhide.classList.add('hide');
                                    }
                                } else {
                                    var dataToggleShowLog = document.getElementById('data-toggle-show-log');

                                    dataToggleShowLog.click();
                                }
                            }
                        }

                        if(document.getElementById('scoreboard') != ""){
                            var startButton = document.getElementById('button-start');
                            startButton.style.display = "block";
                        }

                        var buttonsInOverallPointsBoard = document.getElementById('overall-points-board').getElementsByTagName('path');

                        for(var b = 0; b < buttonsInOverallPointsBoard.length; b++){
                            buttonsInOverallPointsBoard[b].onclick = (function() {

                                return function() {
                                    var score = document.getElementById('score-value').value;

                                    var minusScore = this.innerHTML;

                                    if (count == 0) {
                                        firstArrowStorage = minusScore;
                                        localStorage.setItem('firstArrow', firstArrowStorage);

                                        firstArrowScore = localStorage.getItem('firstArrow');
                                        document.getElementById('current-throw').innerHTML = firstArrowScore;

                                        document.getElementById('arrow-one-fill').style.visibility = 'visible';
                                        document.getElementById('arrow-two-fill').style.visibility = 'hidden';
                                        document.getElementById('arrow-three-fill').style.visibility = 'hidden';

                                        var firstArrowToParagraph = document.createElement('p');
                                        firstArrowToParagraph.innerHTML = 'first arrow';
                                        firstArrowToParagraph.className = 'first-arrow-points';
                                        document.getElementById('points-after-third-arrow').appendChild(firstArrowToParagraph);
                                    } else if(count == 1){
                                        secondArrowStorage = minusScore;
                                        localStorage.setItem('secondArrow', secondArrowStorage);

                                        var secondArrowScore = parseInt(localStorage.getItem('firstArrow')) + parseInt(localStorage.getItem('secondArrow'));
                                        document.getElementById('current-throw').innerHTML = secondArrowScore;

                                        document.getElementById('arrow-two-fill').style.visibility = 'visible';
                                        document.getElementById('arrow-three-fill').style.visibility = 'hidden';
                                        
                                        var secondArrowToParagraph = document.createElement('p');
                                        secondArrowToParagraph.innerHTML = 'second arrow';
                                        secondArrowToParagraph.className = 'second-arrow-points';
                                        document.getElementById('points-after-third-arrow').appendChild(secondArrowToParagraph);
                                    } else if(count == 2){
                                        thirdArrowStorage = minusScore;
                                        localStorage.setItem('thirdArrow', thirdArrowStorage);

                                        var thirdArrowScore = parseInt(localStorage.getItem('firstArrow')) + parseInt(localStorage.getItem('secondArrow')) + parseInt(localStorage.getItem('thirdArrow'));
                                        document.getElementById('current-throw').innerHTML = thirdArrowScore;

                                        document.getElementById('arrow-three-fill').style.visibility = 'visible';
                                        
                                        var thirdArrowToParagraph = document.createElement('p');
                                        thirdArrowToParagraph.innerHTML = thirdArrowScore;
                                        thirdArrowToParagraph.className = 'third-arrow-points';
                                        document.getElementById('points-after-third-arrow').appendChild(thirdArrowToParagraph);
                                    }
                                        
                                    var newScore = score - minusScore;

                                    document.getElementById('score-value').value = newScore;

                                    document.getElementById('score-value').setAttribute("value", newScore);

                                    document.getElementById(scoreTripple20Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble20Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle20Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle20Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple19Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble19Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle19Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle19Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple18Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble18Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle18Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle18Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple17Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble17Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle17Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle17Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple16Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble16Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle16Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle16Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple15Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble15Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle15Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle15Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple14Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble14Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle14Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle14Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple13Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble13Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle13Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle13Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple12Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble12Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle12Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle12Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple11Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble11Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle11Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle11Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple10Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble10Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle10Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle10Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple9Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble9Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle9Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle9Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple8Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble8Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle8Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle8Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple7Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble7Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle7Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle7Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple6Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble6Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle6Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle6Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple5Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble5Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle5Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle5Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple4Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble4Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle4Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle4Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple3Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble3Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle3Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle3Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple2Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble2Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle2Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle2Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple1Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble1Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle1Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle1Name).classList.remove("color-combination");
                                    document.getElementById(scoreBull25Name).classList.remove("color-combination");
                                    document.getElementById(scoreBullsEye50Name).classList.remove("color-combination");

                                    if(document.getElementById('score-value').value > 170){
                                        document.getElementById(scoreTripple20Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble20Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle20Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle20Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple19Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble19Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle19Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle19Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple18Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble18Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle18Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle18Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple17Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble17Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle17Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle17Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple16Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble16Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle16Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle16Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple15Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble15Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle15Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle15Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple14Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble14Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle14Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle14Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple13Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble13Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle13Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle13Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple12Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble12Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle12Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle12Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple11Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble11Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle11Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle11Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple10Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble10Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle10Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle10Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple9Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble9Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle9Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle9Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple8Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble8Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle8Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle8Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple7Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble7Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle7Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle7Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple6Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble6Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle6Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle6Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple5Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble5Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle5Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle5Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple4Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble4Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle4Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle4Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple3Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble3Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle3Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle3Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple2Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble2Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle2Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle2Name).classList.remove("color-combination");

                                        document.getElementById(scoreTripple1Name).classList.remove("color-combination");
                                        document.getElementById(scoreDouble1Name).classList.remove("color-combination");
                                        document.getElementById(scoreTopSingle1Name).classList.remove("color-combination");
                                        document.getElementById(scoreBottomSingle1Name).classList.remove("color-combination");
                                        document.getElementById(scoreBull25Name).classList.remove("color-combination");
                                        document.getElementById(scoreBullsEye50Name).classList.remove("color-combination");
                                    }
                                    
                                    if(document.getElementById('score-value').value <= 170){
                                        document.getElementById('combination').innerHTML = '';
                                        
                                        var combinationToParagraph = document.createElement('h1');

                                        if(document.getElementById('score-value').value == 170){

                                            combinationToParagraph.innerHTML = 'T20 T20 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 169){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        } else if(document.getElementById('score-value').value == 168){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        } else if(document.getElementById('score-value').value == 167){

                                            combinationToParagraph.innerHTML = 'T20 T19 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 166){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 165){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 164){

                                            combinationToParagraph.innerHTML = 'T20 T18 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 163){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 162){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 161){

                                            combinationToParagraph.innerHTML = 'T20 T17 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 160){

                                            combinationToParagraph.innerHTML = 'T20 T20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 159){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 158){

                                            combinationToParagraph.innerHTML = 'T20 T20 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 157){

                                            combinationToParagraph.innerHTML = 'T20 T19 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 156){

                                            combinationToParagraph.innerHTML = 'T20 T20 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 155){

                                            combinationToParagraph.innerHTML = 'T20 T19 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 154){

                                            combinationToParagraph.innerHTML = 'T20 T18 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 153){

                                            combinationToParagraph.innerHTML = 'T20 T19 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 152){

                                            combinationToParagraph.innerHTML = 'T20 T20 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 151){

                                            combinationToParagraph.innerHTML = 'T20 T17 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 150){

                                            combinationToParagraph.innerHTML = 'T20 T18 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 149){

                                            combinationToParagraph.innerHTML = 'T20 T19 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 148){

                                            combinationToParagraph.innerHTML = 'T20 T16 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 147){

                                            combinationToParagraph.innerHTML = 'T20 T17 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 146){

                                            combinationToParagraph.innerHTML = 'T20 T18 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 145){

                                            combinationToParagraph.innerHTML = 'T20 T15 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 144){

                                            combinationToParagraph.innerHTML = 'T20 T20 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 143){

                                            combinationToParagraph.innerHTML = 'T20 T17 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 142){

                                            combinationToParagraph.innerHTML = 'T20 T14 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 141){

                                            combinationToParagraph.innerHTML = 'T20 T19 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 140){

                                            combinationToParagraph.innerHTML = 'T20 T16 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 139){

                                            combinationToParagraph.innerHTML = 'T19 T14 D20';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 138){

                                            combinationToParagraph.innerHTML = 'T20 T18 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 137){

                                            combinationToParagraph.innerHTML = 'T19 T16 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 136){

                                            combinationToParagraph.innerHTML = 'T20 T20 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 135){

                                            combinationToParagraph.innerHTML = 'T20 T17 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 134){

                                            combinationToParagraph.innerHTML = 'T20 T14 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");


                                        } else if(document.getElementById('score-value').value == 133){

                                            combinationToParagraph.innerHTML = 'T20 T19 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 132){

                                            combinationToParagraph.innerHTML = 'T20 T16 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 131){

                                            combinationToParagraph.innerHTML = 'T20 T13 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 130){

                                            combinationToParagraph.innerHTML = 'T20 20 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 129){

                                            combinationToParagraph.innerHTML = 'T19 T16 D12';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 128){

                                            combinationToParagraph.innerHTML = 'T18 T14 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 127){

                                            combinationToParagraph.innerHTML = 'T20 T17 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 126){

                                            combinationToParagraph.innerHTML = 'T19 T19 D6';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 125){

                                            combinationToParagraph.innerHTML = 'T20 25 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreBull25Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 124){

                                            combinationToParagraph.innerHTML = 'T20 T16 D8';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 123){

                                            combinationToParagraph.innerHTML = 'T19 T16 D9 ';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble9Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 122){

                                            combinationToParagraph.innerHTML = 'T20 T18 D4';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 121){

                                            combinationToParagraph.innerHTML = 'T17 T10 D20';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 120){

                                            combinationToParagraph.innerHTML = 'T20 20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 119){

                                            combinationToParagraph.innerHTML = 'T19 T10 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 118){

                                            combinationToParagraph.innerHTML = 'T20 18 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 117){

                                            combinationToParagraph.innerHTML = 'T20 17 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 116){

                                            combinationToParagraph.innerHTML = 'T20 16 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 115){

                                            combinationToParagraph.innerHTML = 'T20 15 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 114){

                                            combinationToParagraph.innerHTML = 'T20 14 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 113){

                                            combinationToParagraph.innerHTML = 'T20 13 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 112){

                                            combinationToParagraph.innerHTML = 'T20 12 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 111){

                                            combinationToParagraph.innerHTML = 'T20 19 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 110){

                                            combinationToParagraph.innerHTML = 'T20 18 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 109){

                                            combinationToParagraph.innerHTML = 'T19 20 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 108){

                                            combinationToParagraph.innerHTML = 'T20 16 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 107){

                                            combinationToParagraph.innerHTML = 'T19 18 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 106){

                                            combinationToParagraph.innerHTML = 'T20 14 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 105){

                                            combinationToParagraph.innerHTML = 'T19 16 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 104){

                                            combinationToParagraph.innerHTML = 'T18 18 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 103){

                                            combinationToParagraph.innerHTML = 'T20 3 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 102){

                                            combinationToParagraph.innerHTML = 'T20 10 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 101){

                                            combinationToParagraph.innerHTML = 'T20 1 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 100){

                                            combinationToParagraph.innerHTML = 'T20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 99){

                                            combinationToParagraph.innerHTML = 'T19 10 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 98){

                                            combinationToParagraph.innerHTML = 'T20 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 97){

                                            combinationToParagraph.innerHTML = 'T19 D20';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 96){

                                            combinationToParagraph.innerHTML = 'T20 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 95){

                                            combinationToParagraph.innerHTML = 'T19 D19';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 94){

                                            combinationToParagraph.innerHTML = 'T18 D20';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 93){

                                            combinationToParagraph.innerHTML = 'T19 D18';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 92){

                                            combinationToParagraph.innerHTML = 'T20 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 91){

                                            combinationToParagraph.innerHTML = 'T17 D20';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 90){

                                            combinationToParagraph.innerHTML = 'T20 D15';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble15Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 89){

                                            combinationToParagraph.innerHTML = 'T19 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 88){

                                            combinationToParagraph.innerHTML = 'T16 D20';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 87){

                                            combinationToParagraph.innerHTML = 'T17 D18';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 86){

                                            combinationToParagraph.innerHTML = 'T18 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 85){

                                            combinationToParagraph.innerHTML = 'T15 D20';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 84){

                                            combinationToParagraph.innerHTML = 'T20 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 83){

                                            combinationToParagraph.innerHTML = 'T17 D16';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 82){

                                            combinationToParagraph.innerHTML = 'T14 D20';

                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 81){

                                            combinationToParagraph.innerHTML = 'T19 D12';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 80){

                                            combinationToParagraph.innerHTML = 'T20 D10';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 79){

                                            combinationToParagraph.innerHTML = 'T13 D20';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 78){

                                            combinationToParagraph.innerHTML = 'T18 D12';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 77){

                                            combinationToParagraph.innerHTML = 'T19 D10';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 76){

                                            combinationToParagraph.innerHTML = 'T20 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 75){

                                            combinationToParagraph.innerHTML = 'T17 D12';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 74){

                                            combinationToParagraph.innerHTML = 'T14 D16';

                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 73){

                                            combinationToParagraph.innerHTML = 'T19 D8';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 72){

                                            combinationToParagraph.innerHTML = 'T16 D12';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 71){

                                            combinationToParagraph.innerHTML = 'T13 D16';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 70){

                                            combinationToParagraph.innerHTML = 'T10 D20';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 69){

                                            combinationToParagraph.innerHTML = 'T15 D12';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 68){

                                            combinationToParagraph.innerHTML = 'T20 D4';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 67){

                                            combinationToParagraph.innerHTML = 'T17 D8';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 66){

                                            combinationToParagraph.innerHTML = 'T10 D18';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 65){

                                            combinationToParagraph.innerHTML = 'T19 D4';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 64){

                                            combinationToParagraph.innerHTML = 'T16 D8';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 63){

                                            combinationToParagraph.innerHTML = 'T13 D12';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 62){

                                            combinationToParagraph.innerHTML = 'T10 D16';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 61){

                                            combinationToParagraph.innerHTML = 'T15 D8';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 60){

                                            combinationToParagraph.innerHTML = '20 D20';

                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 59){

                                            combinationToParagraph.innerHTML = '19 D20';

                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 58){

                                            combinationToParagraph.innerHTML = '18 D20';

                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 57){

                                            combinationToParagraph.innerHTML = '17 D20';

                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 56){

                                            combinationToParagraph.innerHTML = '16 D20';

                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 55){

                                            combinationToParagraph.innerHTML = '15 D20';

                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 54){

                                            combinationToParagraph.innerHTML = '14 D20';

                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 53){

                                            combinationToParagraph.innerHTML = '13 D20';

                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 52){

                                            combinationToParagraph.innerHTML = '20 D16';

                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 51){

                                            combinationToParagraph.innerHTML = '19 D16';

                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 50){

                                            combinationToParagraph.innerHTML = '18 D16';

                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 49){

                                            combinationToParagraph.innerHTML = '17 D16';

                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 48){

                                            combinationToParagraph.innerHTML = '16 D16';

                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 47){

                                            combinationToParagraph.innerHTML = '15 D16';

                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 46){

                                            combinationToParagraph.innerHTML = '14 D16';

                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 45){

                                            combinationToParagraph.innerHTML = '13 D16';

                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 44){

                                            combinationToParagraph.innerHTML = '12 D16';

                                            document.getElementById(scoreTopSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 43){

                                            combinationToParagraph.innerHTML = '11 D16';

                                            document.getElementById(scoreTopSingle11Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle11Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 42){

                                            combinationToParagraph.innerHTML = '10 D16';

                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 41){

                                            combinationToParagraph.innerHTML = '9 D16';

                                            document.getElementById(scoreTopSingle9Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle9Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 40){

                                            combinationToParagraph.innerHTML = 'D20';

                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 39){

                                            combinationToParagraph.innerHTML = '7 D16';

                                            document.getElementById(scoreTopSingle7Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle7Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 38){

                                            combinationToParagraph.innerHTML = 'D19';

                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 37){

                                            combinationToParagraph.innerHTML = '5 D16';

                                            document.getElementById(scoreTopSingle5Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle5Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 36){

                                            combinationToParagraph.innerHTML = 'D18';

                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 35){

                                            combinationToParagraph.innerHTML = '3 D16';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 34){

                                            combinationToParagraph.innerHTML = 'D17';

                                            document.getElementById(scoreDouble17Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 33){

                                            combinationToParagraph.innerHTML = '1 D16';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 32){

                                            combinationToParagraph.innerHTML = 'D16';

                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 31){

                                            combinationToParagraph.innerHTML = '3 D14';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 30){

                                            combinationToParagraph.innerHTML = 'D15';

                                            document.getElementById(scoreDouble15Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 29){

                                            combinationToParagraph.innerHTML = '1 D14';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 28){

                                            combinationToParagraph.innerHTML = 'D14';

                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 27){

                                            combinationToParagraph.innerHTML = '3 D12';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 26){

                                            combinationToParagraph.innerHTML = 'D13';

                                            document.getElementById(scoreDouble13Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 25){
                                            
                                            combinationToParagraph.innerHTML = '1 D12';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 24){

                                            combinationToParagraph.innerHTML = 'D12';

                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 23){

                                            combinationToParagraph.innerHTML = '3 D10';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 22){

                                            combinationToParagraph.innerHTML = 'D11';

                                            document.getElementById(scoreDouble11Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 21){

                                            combinationToParagraph.innerHTML = '1 D10';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 20){

                                            combinationToParagraph.innerHTML = 'D10';

                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 19){

                                            combinationToParagraph.innerHTML = '3 D8';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 18){

                                            combinationToParagraph.innerHTML = 'D9';

                                            document.getElementById(scoreDouble9Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 17){

                                            combinationToParagraph.innerHTML = '1 D8';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 16){

                                            combinationToParagraph.innerHTML = 'D8';

                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 15){

                                            combinationToParagraph.innerHTML = '3 D6';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 14){

                                            combinationToParagraph.innerHTML = 'D7';

                                            document.getElementById(scoreDouble7Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 13){

                                            combinationToParagraph.innerHTML = '1 D6';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 12){

                                            combinationToParagraph.innerHTML = 'D6';

                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 11){

                                            combinationToParagraph.innerHTML = '3 D4';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 10){

                                            combinationToParagraph.innerHTML = 'D5';

                                            document.getElementById(scoreDouble5Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 9){

                                            combinationToParagraph.innerHTML = '1 D4';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 8){

                                            combinationToParagraph.innerHTML = 'D4';

                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 7){

                                            combinationToParagraph.innerHTML = '3 D2';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 6){

                                            combinationToParagraph.innerHTML = 'D3';

                                            document.getElementById(scoreDouble3Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 5){

                                            combinationToParagraph.innerHTML = '1 D2';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 4){

                                            combinationToParagraph.innerHTML = 'D2';

                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 3){

                                            combinationToParagraph.innerHTML = '1 D1';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble1Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 2){

                                            combinationToParagraph.innerHTML = 'D1';

                                            document.getElementById(scoreDouble1Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 1 || document.getElementById('score-value').value < 0){

                                            var score = document.getElementById('score-value').value;
                                            combinationToParagraph.innerHTML = 'BUST';
                                            if (count == 0) {
                                                var scoreBust = parseInt(score) + parseInt(localStorage.getItem('firstArrow'));
                                                document.getElementById('score-value').innerHTML = scoreBust;
                                                document.getElementById('score-value').value = scoreBust;
                                            } else if(count == 1){
                                                var scoreBust = parseInt(score) + parseInt(localStorage.getItem('firstArrow')) + parseInt(localStorage.getItem('secondArrow'));
                                                document.getElementById('score-value').innerHTML = scoreBust;
                                                document.getElementById('score-value').value = scoreBust;
                                            } else if(count == 2){
                                                var scoreBust = parseInt(score) + parseInt(localStorage.getItem('firstArrow')) + parseInt(localStorage.getItem('secondArrow')) + parseInt(localStorage.getItem('thirdArrow'));
                                                document.getElementById('score-value').innerHTML = scoreBust;
                                                document.getElementById('score-value').value = scoreBust;
                                            }
                                        } else if(document.getElementById('score-value').value == 0){

                                            combinationToParagraph.innerHTML = 'WINNER';

                                            var winner; 

                                            winner = document.getElementById('player-name').innerHTML;
                                            localStorage.setItem('winner' , winner);

                                            var gameURL = 'games?game=' + localStorage.getItem('gameType') + '&players=' + JSON.parse(localStorage.getItem('players')) + '&winner=' + localStorage.getItem('winner');

                                            document.getElementById('save-game-link').setAttribute('href', gameURL);
                                            document.getElementById('save-game-link-two').setAttribute('href', gameURL);

                                            var dataToggleSaveGame = document.getElementById('data-toggle-save-game');
                                            dataToggleSaveGame.click();

                                            document.getElementById('winner-name-modal').innerHTML = localStorage.getItem('winner');
                                        }

                                        document.getElementById('combination').appendChild(combinationToParagraph);
                                    }

                                    var pointsToParagraph = document.createElement('p');
                                    pointsToParagraph.innerHTML = minusScore;
                                    pointsToParagraph.className = 'minus-points';
                                    document.getElementById('points-minus-log').appendChild(pointsToParagraph);

                                    var pointsToParagraph = document.createElement('p');
                                    pointsToParagraph.innerHTML = score;
                                    document.getElementById('points-name').appendChild(pointsToParagraph);
                                }
                            })();
                        }

                        var svgclickCounter = document.getElementById("svg"),
                        count = 0;
                        svgclickCounter.onclick = function() {

                            var scoreboard; 

                            scoreboard = document.getElementById('scoreboard').innerHTML;
                            localStorage.setItem('scoreboard',scoreboard);

                            if (count <= 3) {
                                count += 1;
                            }
                            if(count == 3){
                                count = 0;

                                var nextPlayer = document.getElementById('player');
                                nextPlayer.parentNode.appendChild(nextPlayer);
                            }
                            console.log('count : ' + count);
                        };

                        document.getElementById( 'next-player' ).onclick = function() {
                            var nextPlayer = document.getElementById('player');
                            nextPlayer.parentNode.appendChild(nextPlayer);
                            count = 0;
                            console.log('count : ' + count);
                        }

                        document.getElementById( 'previous-player' ).onclick = function() {
                            var previousPlayer = document.getElementById('scoreboard').lastChild;
                            document.getElementById('player').parentNode.prepend(previousPlayer);
                            count = 3;
                            console.log('count : ' + count);
                            if(count == 3){
                                document.getElementsByTagName('svg')[0].setAttribute('class', 'disabled');
                            }
                        }

                        document.getElementById( 'rematch' ).onclick = function(){

                            count = 0;
                            var rematchGameType = localStorage.getItem('gameType');
                            var scoreboard; 

                            pointsName = document.getElementsByClassName('points-name');
                            pointsMinusLog = document.getElementsByClassName('points-minus-log');
                            combination = document.getElementsByClassName('combination');
                            scoreValue = document.getElementsByClassName('score-value');
                            pointsAfterThirdArrow = document.getElementsByClassName('points-after-third-arrow');

                            [].slice.call( pointsName ).forEach(function ( div ) {
                                div.innerHTML = pointsName.innerHTML = "";
                            });

                            [].slice.call( pointsMinusLog ).forEach(function ( div ) {
                                div.innerHTML = pointsMinusLog.innerHTML = "";
                            });

                            [].slice.call( combination ).forEach(function ( div ) {
                                div.innerHTML = combination.innerHTML = "";
                            });

                            [].slice.call( scoreValue ).forEach(function ( input ) {
                                input.value = scoreValue.value = rematchGameType;

                                input.setAttribute('value', rematchGameType);
                            });

                            [].slice.call( pointsAfterThirdArrow ).forEach(function ( div ) {
                                div.innerHTML = pointsAfterThirdArrow.innerHTML = "";
                            });

                            scoreboard = document.getElementById('scoreboard').innerHTML;
                            localStorage.setItem('scoreboard', scoreboard);

                            document.getElementById('arrow-one-fill').style.visibility = 'hidden';
                            document.getElementById('arrow-two-fill').style.visibility = 'hidden';
                            document.getElementById('arrow-three-fill').style.visibility = 'hidden';

                            document.getElementById('current-throw').innerHTML = 0;
                        }

                        var buttonUndo = document.getElementById('button-undo');

                        if (buttonUndo === null){
                            console.log('buttonUndo does not exist');
                        } else{
                            document.getElementById('button-undo').onclick = function() {
                                if (count <= 3 && count > 0) {
                                    count -= 1;
                                }

                                if (document.getElementById('current-throw').innerHTML !=  0){
                                    if (count == 0) {
                                        var firstArrowUndo = parseInt(document.getElementById('current-throw').innerHTML) - parseInt(localStorage.getItem('firstArrow'));
                                        document.getElementById('current-throw').innerHTML = firstArrowUndo;
                                        document.getElementById('arrow-one-fill').style.visibility = 'hidden';

                                        document.getElementsByTagName('svg')[0].removeAttribute('class', 'disabled');
                                    } else if(count == 1){
                                        var secondArrowUndo = parseInt(document.getElementById('current-throw').innerHTML) - parseInt(localStorage.getItem('secondArrow'));
                                        document.getElementById('current-throw').innerHTML = secondArrowUndo;
                                        document.getElementById('arrow-two-fill').style.visibility = 'hidden';

                                        document.getElementsByTagName('svg')[0].removeAttribute('class', 'disabled');
                                    } else if(count == 2){
                                        var thirdArrowUndo = parseInt(document.getElementById('current-throw').innerHTML) - parseInt(localStorage.getItem('thirdArrow'));
                                        document.getElementById('current-throw').innerHTML = thirdArrowUndo;
                                        document.getElementById('arrow-three-fill').style.visibility = 'hidden';

                                        document.getElementsByTagName('svg')[0].removeAttribute('class', 'disabled');
                                    }
                                }
                                
                                console.log('count : ' + count);
                                if(document.getElementById('points-name').innerHTML != ''){

                                    //Delete points input
                                    var scorevalueDeleteInput = document.getElementById('score-value');
                                    scorevalueDeleteInput.remove(scorevalueDeleteInput);

                                    var previousPointsInner = document.getElementById('points-name').lastChild.innerHTML;
                                    var previousPointsMinusInner = document.getElementById('points-minus-log').lastChild.innerHTML;

                                    //Poins to input
                                    var pointsToInput = document.createElement('input');
                                    //pointsToInput.innerHTML = previousPointsInner;
                                    pointsToInput.value = previousPointsInner;
                                    pointsToInput.className = 'form-control form-control-points score-value';
                                    pointsToInput.id = 'score-value';
                                    pointsToInput.setAttribute("value", previousPointsInner);
                                    pointsToInput.setAttribute("disabled", "disabled");
                                    document.getElementById('point-input').appendChild(pointsToInput);

                                    var previousPoints = document.getElementById('points-name').lastChild;
                                    var previousPointsMinus = document.getElementById('points-minus-log').lastChild;
                                    var previousArrow = document.getElementById('points-after-third-arrow').lastChild;

                                    previousPoints.remove(previousPoints);
                                    previousPointsMinus.remove(previousPointsMinus);
                                    previousArrow.remove(previousArrow);

                                    document.getElementById('combination').innerHTML = '';

                                    document.getElementById(scoreTripple20Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble20Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle20Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle20Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple19Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble19Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle19Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle19Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple18Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble18Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle18Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle18Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple17Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble17Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle17Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle17Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple16Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble16Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle16Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle16Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple15Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble15Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle15Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle15Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple14Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble14Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle14Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle14Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple13Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble13Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle13Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle13Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple12Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble12Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle12Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle12Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple11Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble11Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle11Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle11Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple10Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble10Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle10Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle10Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple9Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble9Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle9Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle9Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple8Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble8Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle8Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle8Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple7Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble7Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle7Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle7Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple6Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble6Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle6Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle6Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple5Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble5Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle5Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle5Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple4Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble4Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle4Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle4Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple3Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble3Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle3Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle3Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple2Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble2Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle2Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle2Name).classList.remove("color-combination");

                                    document.getElementById(scoreTripple1Name).classList.remove("color-combination");
                                    document.getElementById(scoreDouble1Name).classList.remove("color-combination");
                                    document.getElementById(scoreTopSingle1Name).classList.remove("color-combination");
                                    document.getElementById(scoreBottomSingle1Name).classList.remove("color-combination");
                                    document.getElementById(scoreBull25Name).classList.remove("color-combination");
                                    document.getElementById(scoreBullsEye50Name).classList.remove("color-combination");

                                    if(document.getElementById('score-value').value <= 170){
                                        
                                        //dataToggle.click();
                                        document.getElementById('combination').innerHTML = '';
                                        var combinationToParagraph = document.createElement('h1');

                                        if(document.getElementById('score-value').value == 170){

                                            combinationToParagraph.innerHTML = 'T20 T20 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 169){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        } else if(document.getElementById('score-value').value == 168){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        } else if(document.getElementById('score-value').value == 167){

                                            combinationToParagraph.innerHTML = 'T20 T19 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 166){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 165){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 164){

                                            combinationToParagraph.innerHTML = 'T20 T18 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 163){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 162){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 161){

                                            combinationToParagraph.innerHTML = 'T20 T17 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 160){

                                            combinationToParagraph.innerHTML = 'T20 T20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 159){

                                            combinationToParagraph.innerHTML = '--- No out shot ---';

                                        }  else if(document.getElementById('score-value').value == 158){

                                            combinationToParagraph.innerHTML = 'T20 T20 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 157){

                                            combinationToParagraph.innerHTML = 'T20 T19 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 156){

                                            combinationToParagraph.innerHTML = 'T20 T20 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 155){

                                            combinationToParagraph.innerHTML = 'T20 T19 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 154){

                                            combinationToParagraph.innerHTML = 'T20 T18 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 153){

                                            combinationToParagraph.innerHTML = 'T20 T19 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 152){

                                            combinationToParagraph.innerHTML = 'T20 T20 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 151){

                                            combinationToParagraph.innerHTML = 'T20 T17 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 150){

                                            combinationToParagraph.innerHTML = 'T20 T18 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 149){

                                            combinationToParagraph.innerHTML = 'T20 T19 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 148){

                                            combinationToParagraph.innerHTML = 'T20 T16 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 147){

                                            combinationToParagraph.innerHTML = 'T20 T17 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 146){

                                            combinationToParagraph.innerHTML = 'T20 T18 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 145){

                                            combinationToParagraph.innerHTML = 'T20 T15 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 144){

                                            combinationToParagraph.innerHTML = 'T20 T20 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 143){

                                            combinationToParagraph.innerHTML = 'T20 T17 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 142){

                                            combinationToParagraph.innerHTML = 'T20 T14 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 141){

                                            combinationToParagraph.innerHTML = 'T20 T19 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 140){

                                            combinationToParagraph.innerHTML = 'T20 T16 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        }  else if(document.getElementById('score-value').value == 139){

                                            combinationToParagraph.innerHTML = 'T19 T14 D20';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 138){

                                            combinationToParagraph.innerHTML = 'T20 T18 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 137){

                                            combinationToParagraph.innerHTML = 'T19 T16 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 136){

                                            combinationToParagraph.innerHTML = 'T20 T20 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 135){

                                            combinationToParagraph.innerHTML = 'T20 T17 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 134){

                                            combinationToParagraph.innerHTML = 'T20 T14 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");


                                        } else if(document.getElementById('score-value').value == 133){

                                            combinationToParagraph.innerHTML = 'T20 T19 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 132){

                                            combinationToParagraph.innerHTML = 'T20 T16 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 131){

                                            combinationToParagraph.innerHTML = 'T20 T13 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 130){

                                            combinationToParagraph.innerHTML = 'T20 20 Bull';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBullsEye50Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 129){

                                            combinationToParagraph.innerHTML = 'T19 T16 D12';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 128){

                                            combinationToParagraph.innerHTML = 'T18 T14 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 127){

                                            combinationToParagraph.innerHTML = 'T20 T17 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 126){

                                            combinationToParagraph.innerHTML = 'T19 T19 D6';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 125){

                                            combinationToParagraph.innerHTML = 'T20 25 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreBull25Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 124){

                                            combinationToParagraph.innerHTML = 'T20 T16 D8';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 123){

                                            combinationToParagraph.innerHTML = 'T19 T16 D9 ';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble9Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 122){

                                            combinationToParagraph.innerHTML = 'T20 T18 D4';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 121){

                                            combinationToParagraph.innerHTML = 'T17 T10 D20';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 120){

                                            combinationToParagraph.innerHTML = 'T20 20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 119){

                                            combinationToParagraph.innerHTML = 'T19 T10 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 118){

                                            combinationToParagraph.innerHTML = 'T20 18 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 117){

                                            combinationToParagraph.innerHTML = 'T20 17 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 116){

                                            combinationToParagraph.innerHTML = 'T20 16 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 115){

                                            combinationToParagraph.innerHTML = 'T20 15 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 114){

                                            combinationToParagraph.innerHTML = 'T20 14 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 113){

                                            combinationToParagraph.innerHTML = 'T20 13 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 112){

                                            combinationToParagraph.innerHTML = 'T20 12 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 111){

                                            combinationToParagraph.innerHTML = 'T20 19 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 110){

                                            combinationToParagraph.innerHTML = 'T20 18 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 109){

                                            combinationToParagraph.innerHTML = 'T19 20 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 108){

                                            combinationToParagraph.innerHTML = 'T20 16 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 107){

                                            combinationToParagraph.innerHTML = 'T19 18 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 106){

                                            combinationToParagraph.innerHTML = 'T20 14 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 105){

                                            combinationToParagraph.innerHTML = 'T19 16 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 104){

                                            combinationToParagraph.innerHTML = 'T18 18 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 103){

                                            combinationToParagraph.innerHTML = 'T20 3 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 102){

                                            combinationToParagraph.innerHTML = 'T20 10 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 101){

                                            combinationToParagraph.innerHTML = 'T20 1 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 100){

                                            combinationToParagraph.innerHTML = 'T20 D20';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 99){

                                            combinationToParagraph.innerHTML = 'T19 10 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 98){

                                            combinationToParagraph.innerHTML = 'T20 D19';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 97){

                                            combinationToParagraph.innerHTML = 'T19 D20';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 96){

                                            combinationToParagraph.innerHTML = 'T20 D18';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 95){

                                            combinationToParagraph.innerHTML = 'T19 D19';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 94){

                                            combinationToParagraph.innerHTML = 'T18 D20';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 93){

                                            combinationToParagraph.innerHTML = 'T19 D18';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 92){

                                            combinationToParagraph.innerHTML = 'T20 D16';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 91){

                                            combinationToParagraph.innerHTML = 'T17 D20';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 90){

                                            combinationToParagraph.innerHTML = 'T20 D15';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble15Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 89){

                                            combinationToParagraph.innerHTML = 'T19 D16';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 88){

                                            combinationToParagraph.innerHTML = 'T16 D20';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 87){

                                            combinationToParagraph.innerHTML = 'T17 D18';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 86){

                                            combinationToParagraph.innerHTML = 'T18 D16';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 85){

                                            combinationToParagraph.innerHTML = 'T15 D20';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 84){

                                            combinationToParagraph.innerHTML = 'T20 D12';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 83){

                                            combinationToParagraph.innerHTML = 'T17 D16';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 82){

                                            combinationToParagraph.innerHTML = 'T14 D20';

                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 81){

                                            combinationToParagraph.innerHTML = 'T19 D12';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 80){

                                            combinationToParagraph.innerHTML = 'T20 D10';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 79){

                                            combinationToParagraph.innerHTML = 'T13 D20';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 78){

                                            combinationToParagraph.innerHTML = 'T18 D12';

                                            document.getElementById(scoreTripple18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 77){

                                            combinationToParagraph.innerHTML = 'T19 D10';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 76){

                                            combinationToParagraph.innerHTML = 'T20 D8';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 75){

                                            combinationToParagraph.innerHTML = 'T17 D12';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 74){

                                            combinationToParagraph.innerHTML = 'T14 D16';

                                            document.getElementById(scoreTripple14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 73){

                                            combinationToParagraph.innerHTML = 'T19 D8';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 72){

                                            combinationToParagraph.innerHTML = 'T16 D12';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 71){

                                            combinationToParagraph.innerHTML = 'T13 D16';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 70){

                                            combinationToParagraph.innerHTML = 'T10 D20';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 69){

                                            combinationToParagraph.innerHTML = 'T15 D12';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 68){

                                            combinationToParagraph.innerHTML = 'T20 D4';

                                            document.getElementById(scoreTripple20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 67){

                                            combinationToParagraph.innerHTML = 'T17 D8';

                                            document.getElementById(scoreTripple17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 66){

                                            combinationToParagraph.innerHTML = 'T10 D18';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 65){

                                            combinationToParagraph.innerHTML = 'T19 D4';

                                            document.getElementById(scoreTripple19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 64){

                                            combinationToParagraph.innerHTML = 'T16 D8';

                                            document.getElementById(scoreTripple16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 63){

                                            combinationToParagraph.innerHTML = 'T13 D12';

                                            document.getElementById(scoreTripple13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 62){

                                            combinationToParagraph.innerHTML = 'T10 D16';

                                            document.getElementById(scoreTripple10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 61){

                                            combinationToParagraph.innerHTML = 'T15 D8';

                                            document.getElementById(scoreTripple15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 60){

                                            combinationToParagraph.innerHTML = '20 D20';

                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 59){

                                            combinationToParagraph.innerHTML = '19 D20';

                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 58){

                                            combinationToParagraph.innerHTML = '18 D20';

                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 57){

                                            combinationToParagraph.innerHTML = '17 D20';

                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 56){

                                            combinationToParagraph.innerHTML = '16 D20';

                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 55){

                                            combinationToParagraph.innerHTML = '15 D20';

                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 54){

                                            combinationToParagraph.innerHTML = '14 D20';

                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 53){

                                            combinationToParagraph.innerHTML = '13 D20';

                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 52){

                                            combinationToParagraph.innerHTML = '20 D16';

                                            document.getElementById(scoreTopSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle20Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 51){

                                            combinationToParagraph.innerHTML = '19 D16';

                                            document.getElementById(scoreTopSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle19Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 50){

                                            combinationToParagraph.innerHTML = '18 D16';

                                            document.getElementById(scoreTopSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle18Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 49){

                                            combinationToParagraph.innerHTML = '17 D16';

                                            document.getElementById(scoreTopSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle17Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 48){

                                            combinationToParagraph.innerHTML = '16 D16';

                                            document.getElementById(scoreTopSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle16Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 47){

                                            combinationToParagraph.innerHTML = '15 D16';

                                            document.getElementById(scoreTopSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle15Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 46){

                                            combinationToParagraph.innerHTML = '14 D16';

                                            document.getElementById(scoreTopSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle14Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 45){

                                            combinationToParagraph.innerHTML = '13 D16';

                                            document.getElementById(scoreTopSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle13Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 44){

                                            combinationToParagraph.innerHTML = '12 D16';

                                            document.getElementById(scoreTopSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle12Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 43){

                                            combinationToParagraph.innerHTML = '11 D16';

                                            document.getElementById(scoreTopSingle11Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle11Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 42){

                                            combinationToParagraph.innerHTML = '10 D16';

                                            document.getElementById(scoreTopSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle10Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 41){

                                            combinationToParagraph.innerHTML = '9 D16';

                                            document.getElementById(scoreTopSingle9Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle9Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 40){

                                            combinationToParagraph.innerHTML = 'D20';

                                            document.getElementById(scoreDouble20Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 39){

                                            combinationToParagraph.innerHTML = '7 D16';

                                            document.getElementById(scoreTopSingle7Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle7Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 38){

                                            combinationToParagraph.innerHTML = 'D19';

                                            document.getElementById(scoreDouble19Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 37){

                                            combinationToParagraph.innerHTML = '5 D16';

                                            document.getElementById(scoreTopSingle5Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle5Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 36){

                                            combinationToParagraph.innerHTML = 'D18';

                                            document.getElementById(scoreDouble18Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 35){

                                            combinationToParagraph.innerHTML = '3 D16';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 34){

                                            combinationToParagraph.innerHTML = 'D17';

                                            document.getElementById(scoreDouble17Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 33){

                                            combinationToParagraph.innerHTML = '1 D16';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 32){

                                            combinationToParagraph.innerHTML = 'D16';

                                            document.getElementById(scoreDouble16Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 31){

                                            combinationToParagraph.innerHTML = '3 D14';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 30){

                                            combinationToParagraph.innerHTML = 'D15';

                                            document.getElementById(scoreDouble15Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 29){

                                            combinationToParagraph.innerHTML = '1 D14';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 28){

                                            combinationToParagraph.innerHTML = 'D14';

                                            document.getElementById(scoreDouble14Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 27){

                                            combinationToParagraph.innerHTML = '3 D12';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 26){

                                            combinationToParagraph.innerHTML = 'D13';

                                            document.getElementById(scoreDouble13Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 25){
                                            
                                            combinationToParagraph.innerHTML = '1 D12';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 24){

                                            combinationToParagraph.innerHTML = 'D12';

                                            document.getElementById(scoreDouble12Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 23){

                                            combinationToParagraph.innerHTML = '3 D10';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 22){

                                            combinationToParagraph.innerHTML = 'D11';

                                            document.getElementById(scoreDouble11Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 21){

                                            combinationToParagraph.innerHTML = '1 D10';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 20){

                                            combinationToParagraph.innerHTML = 'D10';

                                            document.getElementById(scoreDouble10Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 19){

                                            combinationToParagraph.innerHTML = '3 D8';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 18){

                                            combinationToParagraph.innerHTML = 'D9';

                                            document.getElementById(scoreDouble9Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 17){

                                            combinationToParagraph.innerHTML = '1 D8';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 16){

                                            combinationToParagraph.innerHTML = 'D8';

                                            document.getElementById(scoreDouble8Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 15){

                                            combinationToParagraph.innerHTML = '3 D6';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 14){

                                            combinationToParagraph.innerHTML = 'D7';

                                            document.getElementById(scoreDouble7Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 13){

                                            combinationToParagraph.innerHTML = '1 D6';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 12){

                                            combinationToParagraph.innerHTML = 'D6';

                                            document.getElementById(scoreDouble6Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 11){

                                            combinationToParagraph.innerHTML = '3 D4';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 10){

                                            combinationToParagraph.innerHTML = 'D5';

                                            document.getElementById(scoreDouble5Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 9){

                                            combinationToParagraph.innerHTML = '1 D4';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 8){

                                            combinationToParagraph.innerHTML = 'D4';

                                            document.getElementById(scoreDouble4Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 7){

                                            combinationToParagraph.innerHTML = '3 D2';

                                            document.getElementById(scoreTopSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle3Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 6){

                                            combinationToParagraph.innerHTML = 'D3';

                                            document.getElementById(scoreDouble3Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 5){

                                            combinationToParagraph.innerHTML = '1 D2';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 4){

                                            combinationToParagraph.innerHTML = 'D2';

                                            document.getElementById(scoreDouble2Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 3){

                                            combinationToParagraph.innerHTML = '1 D1';

                                            document.getElementById(scoreTopSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreBottomSingle1Name).classList.add("color-combination");
                                            document.getElementById(scoreDouble1Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 2){

                                            combinationToParagraph.innerHTML = 'D1';

                                            document.getElementById(scoreDouble1Name).classList.add("color-combination");

                                        } else if(document.getElementById('score-value').value == 0){

                                            combinationToParagraph.innerHTML = 'WINNER';

                                        } else if(document.getElementById('score-value').value < 0){

                                            combinationToParagraph.innerHTML = 'BUST';

                                        }

                                        document.getElementById('combination').appendChild(combinationToParagraph);
                                        }
                                } else{
                                    var dataToggle = document.getElementById('data-toggle-button-undo');

                                    dataToggle.click();
                                }
                            }
                        }
                    }
                }
                return playersArray;
            }
        </script>
    </body>
</html>