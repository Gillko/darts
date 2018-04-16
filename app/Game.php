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
	protected $fillable = ['name', 'date', 'hour'];

	protected $table ='games';

	protected $primaryKey = 'id';

	public function players(){
	    return $this->belongsToMany('App\Player')->withTimestamps();
	}

	public function scores(){
        return $this->hasMany('App\Score');
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
