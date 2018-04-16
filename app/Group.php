<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['name'];

	protected $table ='groups';

	protected $primaryKey = 'id';

	public function players(){
    	return $this->belongsToMany('App\Player')->withTimestamps();
    }

  	/**
	*Get a list of player ids associated with the current group.
	*
	*@return array
	*/
	public function getPlayersListAttribute()
	{
		return $this->players->lists('group_id')->all();
	}
}