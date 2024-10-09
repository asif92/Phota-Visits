<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'status';
	protected $fillable = [
	'status_name','status_color'
	];


	public function MyEventParticipants()
	{
		return $this->hasOne('App\MyEventParticipant');
	}

}
