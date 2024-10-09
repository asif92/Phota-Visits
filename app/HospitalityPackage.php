<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalityPackage extends Model
{
	protected $table = 'hospitality_packages';
	protected $fillable = [
	'package_item_menu'
	];

	public function myEvent()
	{
		return $this->hasMany('App\MyEvent');
	}
}
