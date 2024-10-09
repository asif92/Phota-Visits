<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
	protected $table = 'participants';
	protected $fillable = [
	'participant_name','participant_contact','participant_address'
	];


	public function MyEventParticipants()
	{
		return $this->hasMany('App\MyEventParticipant');
	}


	
	public function eventVehicles()
	{
		return $this->morphMany('App\EventVehicle', 'vehicleable');
	}

	

}
