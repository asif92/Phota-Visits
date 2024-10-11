<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
	use SoftDeletes;

	protected $table = 'vehicles';
	protected $fillable = [
	'vehicle_registation_number','vehicle_maker'
	];
	

	public function eventVehicle()
	{
		return $this->hasOne('App\EventVehicle');
	}



}
