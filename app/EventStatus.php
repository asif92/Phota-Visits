<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventStatus extends Model
{
	use SoftDeletes;
	protected $table = 'event_status';
	protected $fillable = [
	'event_status_name','event_status_color'
	];


	public function myEvent()
	{
		return $this->hasOne('App\MyEvent');
	}
}
