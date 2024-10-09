<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
	protected $table = 'vehicles';
	protected $fillable = [
	'vehicle_registation_number','vehicle_maker'
	];
	

	public function eventVehicle()
	{
		return $this->hasOne('App\EventVehicle');
	}



}
