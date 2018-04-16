<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['arrow', 'score', 'player_id', 'game_id'];

	protected $table ='scores';

	protected $primaryKey = 'id';

	public function player(){
        return $this->belongsTo('App\Player');
    }

    public function game(){
        return $this->belongsTo('App\Game');
    }
}