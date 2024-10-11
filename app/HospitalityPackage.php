<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HospitalityPackage extends Model
{
	use SoftDeletes;
	protected $table = 'hospitality_packages';
	protected $fillable = [
	'package_item_menu'
	];

	public function myEvent()
	{
		return $this->hasMany('App\MyEvent');
	}
}
