<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventVehicle extends Model
{

	use SoftDeletes;
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
