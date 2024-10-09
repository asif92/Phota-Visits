<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
	protected $table = 'event_status';
	protected $fillable = [
	'event_status_name','event_status_color'
	];


	public function myEvent()
	{
		return $this->hasOne('App\MyEvent');
	}
}
