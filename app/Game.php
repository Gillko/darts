<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['name', 'date', 'hour', 'type', 'winner'];

	protected $table ='games';

	protected $primaryKey = 'id';

	public function players(){
	    return $this->belongsToMany('App\Player')->withTimestamps();
	}

	public function scores(){
        return $this->hasMany('App\Score');
    }

    //this is for the winner of the game
    /*public function winner(){
        return $this->hasOne('App\Player', 'winner', 'player_id');
    }*/

    public function player(){
        return $this->belongsTo('App\Player', 'winner');
    }

	/**
	*Get a list of players ids associated with the current game.
	*
	*@return array
	*/
	public function getPlayersListAttribute()
	{
		return $this->players->lists('game_id')->all();
	}
}