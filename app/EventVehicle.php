<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventVehicle extends Model
{

	protected $table = 'event_vehicles';
	protected $fillable = [
	'vehicle_id','vehicleable_id','vehicleable_type','status_id'
	];


	public function vehicleable()
	{
		return $this->morphTo();
	}

	public function vehicle()
	{
		return $this->belongsTo('App\Vehicle','vehicle_id');
	}

	public function status()
	{
		return $this->belongsTo('App\Status');
	}


}
