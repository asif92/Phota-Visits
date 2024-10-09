<?php

use App\EventStatus;
use App\EventType;
use App\HospitalityPackage;
use App\MyEvent;
use App\MyEventParticipant;
use App\Participant;
use App\Status;
use App\User;
use App\Vehicle;
use Illuminate\Database\Seeder;

class AdminSeed extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		EventType::create(array(
			'event_type_name' => 'meeting',
			'event_type_color' => 'red',
		));

		EventType::create(array(
			'event_type_name' => 'private_meeting',
			'event_type_color' => 'blue',
		));

		EventType::create(array(
			'event_type_name' => 'visit',
			'event_type_color' => 'green',
		));

		EventStatus::create(array(
			'event_status_name' => 'upcoming',
			'event_status_color' => '#fff', //white
		));

		EventStatus::create(array(
			'event_status_name' => 'next',
			'event_status_color' => '#989aa9', //gray
		));

		EventStatus::create(array(
			'event_status_name' => 'inprocess',
			'event_status_color' => '#2638ec', //blue
		));

		EventStatus::create(array(
			'event_status_name' => 'complete',
			'event_status_color' => '#1ca219', // green
		));

		EventStatus::create(array(
			'event_status_name' => 'cancel',
			'event_status_color' => '#eb2d2b', //red
		));

		EventStatus::create(array(
			'event_status_name' => 'past',
			'event_status_color' => '#cfa4a4', //white
		));

		Status::create(array(
			'status_name' => 'expected',
			'status_color' => '#fff',
		));

		Status::create(array(
			'status_name' => 'arrived',
			'status_color' => '#1ca219',
		));

		Status::create(array(
			'status_name' => 'arrivedconfirmed',
			'status_color' => '#1ca219',
		));

		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 1',
		));
		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 2',
		));
		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 3',
		));
		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 4',
		));
		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 5',
		));
		HospitalityPackage::create(array(
			'package_item_menu' => 'Package 6',
		));

		Participant::create(array(
			'participant_name' => 'Dr Farooq',
			'participant_contact' => '03004403939',
			'participant_email' => 'adnan@alphaaspire.com',
		));

		Participant::create(array(
			'participant_name' => 'Dr Ijaz',
			'participant_contact' => '03009898779',
			'participant_email' => 'adnan@alphaaspire.com',
		));

		Participant::create(array(
			'participant_name' => 'Mr Bilal',
			'participant_contact' => '03005688789',
			'participant_email' => 'adnan@alphaaspire.com',
		));

		Participant::create(array(
			'participant_name' => 'Ahmed Ali',
			'participant_contact' => '03029983790',
			'participant_email' => 'adnan@alphaaspire.com',
		));

		Vehicle::create(array(
			'vehicle_registation_number' => 'LWP 3243',
			'vehicle_maker' => 'TOYOTA',
		));

		Vehicle::create(array(
			'vehicle_registation_number' => 'LES 4555',
		));

		Vehicle::create(array(
			'vehicle_registation_number' => 'LEO 5533',
		));

		MyEvent::create(array(
			'event_type_id' => '1',
			'event_title' => 'new meeting one',
			'event_description' => 'First Meeting Description',
			'event_date' => '24-June-2017',
			'event_time' => "12:30 PM",
			'time_span' => "30",
		));

		MyEvent::create(array(
			'event_type_id' => '1',
			'event_title' => 'new meeting second',
			'event_description' => 'Second Meeting Description',
			'event_date' => '24-June-2017',
			'event_time' => "2:30 PM",
			'time_span' => "30",
		));

		User::create(array(
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'user_type' => 'Admin',
			'password' => bcrypt('password'),
		));

		User::create(array(
			'name' => 'gatekeeper',
			'email' => 'gatekeeper@gatekeeper.com',
			'user_type' => 'Gatekeeper',
			'password' => bcrypt('password'),
		));

		MyEventParticipant::create(array(
			'my_event_id' => '1',
			'participant_id' => '1',
			'status_id' => '1',
		));
		MyEventParticipant::create(array(
			'my_event_id' => '1',
			'participant_id' => '2',
			'status_id' => '1',
		));
		MyEventParticipant::create(array(
			'my_event_id' => '1',
			'participant_id' => '3',
			'status_id' => '1',
		));

		User::create(array(
			'name' => 'DGSuperAdmin',
			'email' => 'superadmin@superadmin.com',
			'user_type' => 'SuperAdmin',
			'password' => bcrypt('password'),
		));

	}
}
