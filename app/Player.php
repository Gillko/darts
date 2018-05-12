<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['firstname', 'lastname', 'nickname'];

	protected $table ='players';

	protected $primaryKey = 'id';

	public function groups(){
	    return $this->belongsToMany('App\Group')->withTimestamps();
	}

	public function games(){
    	return $this->belongsToMany('App\Game')->withTimestamps();
    }

    public function scores(){
        return $this->hasMany('App\Score');
    }

    //the game the player has won
    public function game(){
        return $this->hasOne('App\Game');
    }

    public function won(){
    	return $this->hasMany(Game::class, 'winner');
	}

	/**
	*Get a list of groups ids associated with the current player.
	*
	*@return array
	*/
	public function getGroupsListAttribute()
	{
		return $this->groups->lists('player_id')->all();
	}
}