<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyEventParticipant extends Model
{
	protected $table = 'my_event_participant';
	protected $fillable = [
	'my_event_id','participant_id','status_id',
	];

	public function myEvent()
	{
		return $this->belongsTo('App\MyEvent');
	}

	public function participant()
	{
		return $this->belongsTo('App\Participant');
	}

	public function status()
	{
		return $this->belongsTo('App\Status');
	}



}
