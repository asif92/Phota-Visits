<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
	protected $table = 'event_types';
	protected $fillable = [
	'event_type_name'
	];


	public function myEvent()
	{
		return $this->hasOne('App\MyEvent');
	}


}
