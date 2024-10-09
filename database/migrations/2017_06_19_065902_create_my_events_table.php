<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyEventsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('my_events', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('event_type_id')->unsigned()->nullable();
			$table->string('event_title')->nullable();
			$table->string('event_description')->nullable();
			$table->string('event_venue')->nullable();
			$table->string('event_date');
			$table->string('inviting_official')->nullable()->default("DG");
			$table->tinyInteger('hospitality_allowed')->default(0);
			$table->string('event_time');
			$table->string('event_remarks')->nullable();
			$table->string('time_span');
			$table->tinyInteger('event_confirmation_approval')->default(0);
			$table->integer('event_status_id')->unsigned()->default(1);
			$table->foreign('event_status_id')
				->references('id')
				->on('event_status')
				->onDelete('cascade');

			$table->integer('hospitality_package_id')->unsigned()->nullable();
			$table->foreign('hospitality_package_id')
				->references('id')
				->on('hospitality_packages')
				->onDelete('cascade');

			$table->foreign('event_type_id')
				->references('id')
				->on('event_types')
				->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('my_event_participant', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('my_event_id')->unsigned();
			$table->foreign('my_event_id')
				->references('id')
				->on('my_events')
				->onDelete('cascade');

			$table->integer('participant_id')->unsigned();
			$table->foreign('participant_id')
				->references('id')
				->on('participants')
				->onDelete('cascade');

			$table->integer('status_id')->unsigned()->default(1);
			$table->foreign('status_id')
				->references('id')
				->on('status')
				->onDelete('cascade');

			$table->timestamps();
		});

		Schema::create('event_vehicles', function (Blueprint $table) {

			$table->increments('id');

			$table->integer('vehicle_id')->unsigned();
			$table->foreign('vehicle_id')
				->references('id')
				->on('vehicles')
				->onDelete('cascade');

			$table->integer('status_id')->unsigned()->default(1);
			$table->foreign('status_id')
				->references('id')
				->on('status')
				->onDelete('cascade');

			$table->integer('vehicleable_id');
			$table->string('vehicleable_type');
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('event_vehicles');
		Schema::dropIfExists('my_event_participant');
		Schema::dropIfExists('my_events');
	}
}
