<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtrnalEvents extends Model
{
	use SoftDeletes;
	protected $fillable = [
	'event_title', 'event_description', 'event_venue', 'event_date', 'event_time','event_remarks'
	];
}
