<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Game;
use App\Player;
use Validator;
use Response;

class GamesController extends Controller
{

    /**
    * @var array
    */
    protected $rules =
    [
        'name'      => 'required',
        'date'      => 'required',
        'hour'      => 'required',
        'players'   => 'required',
        'winner'    => 'required'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['store', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Get the groups*/
        $games = Game::orderBy('id', 'DESC')->get();

        $lastinsertid = Game::all()->last();

        $players = Player::select('firstname', 'id')->get();

        return \View::make('games.index', compact('games', 'players', 'lastinsertid'));

        /*Load the view and pass the groups*/
        //return \View::make('games.index')->with('games', $games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$games = Game::all();

        $players = Player::select('firstname', 'id')->get();

        return \View::make('games.create', compact('games', 'players'));*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$input = request()->validate([
            'name' => 'required',
            'date' => 'required',
            'hour' => 'required',
        ]);
        $input = request()->all();
        $game = Game::create($input);

        $game->players()->attach($request->input('player_list'));

        return redirect('games/create')->with('success', 'The Game has been created!');*/

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $game = new Game();
            $game->name     = $request->name;
            $game->date     = $request->date;
            $game->hour     = $request->hour;
            //$game->players  = $request->players;
            //$game->players()->attach('players_list');

           

            $game->winner = $request->winner;
            $game->save();
            $game->players()->attach($request->players);
            return response()->json($game);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        return \View::make('games.show')->with('game', $game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Change resource status.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() 
    {
        $id = Input::get('id');

        $game = Game::findOrFail($id);
        //$post->is_published = !$post->is_published;
        $game->save();

        return response()->json($game);
    }
}
