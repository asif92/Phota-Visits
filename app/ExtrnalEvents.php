<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtrnalEvents extends Model
{
	protected $fillable = [
	'event_title', 'event_description', 'event_venue', 'event_date', 'event_time','event_remarks'
	];
}
