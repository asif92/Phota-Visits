<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyEvent extends Model
{
	use SoftDeletes;
	protected $table = 'my_events';
	protected $fillable = [
	'event_type_id','event_title','event_description', 'event_date','event_time','event_status_id','event_venue','hospitality_package_id','time_span','event_remarks'
	];


	public function MyEventParticipants()
	{
		return $this->hasMany('App\MyEventParticipant');
	}


	public function eventType()
	{
		return $this->belongsTo('App\EventType');
	}



	public function hospitalityPackage()
	{
		return $this->belongsTo('App\HospitalityPackage');
	}


	public function eventStatus()
	{
		return $this->belongsTo('App\EventStatus');
	}



	public function eventVehicles()
	{
		return $this->morphMany('App\EventVehicle', 'vehicleable');
	}




	public function setEventTimeAttribute($time)
	{
		$flag1 = str_contains($time, 'AM');
		$flag2 = str_contains($time, 'PM');

		if($flag1 || $flag2)
		{
			$this->attributes['event_time'] = DateTime::createFromFormat('h:i A',$time);
		}
		else 
		{
			$this->attributes['event_time'] = $time;
		}
	}

	public function getEventTimeAttribute()
	{
		return Carbon::parse($this->attributes['event_time'])->format('h:i A');
	}




	public function setEventDateAttribute($date)
	{
		$flag = str_contains($date, '-');
		if($flag)
		{
			$this->attributes['event_date'] = DateTime::createFromFormat('d-M-Y', $date)->format('Y-m-d'); 
		}
		else 
		{
			$this->attributes['event_date'] = $date;
		}

	}

	public function getEventDateAttribute()
	{
		return Carbon::parse($this->attributes['event_date'])->format('d-M-Y');
	}










}
