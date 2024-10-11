<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
	use SoftDeletes;
	protected $table = 'status';
	protected $fillable = [
	'status_name','status_color'
	];


	public function MyEventParticipants()
	{
		return $this->hasOne('App\MyEventParticipant');
	}

}
