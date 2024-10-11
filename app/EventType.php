<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
	use SoftDeletes;
	protected $table = 'event_types';
	protected $fillable = [
	'event_type_name'
	];


	public function myEvent()
	{
		return $this->hasOne('App\MyEvent');
	}


}
