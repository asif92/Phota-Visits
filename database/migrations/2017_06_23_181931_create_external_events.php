<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalEvents extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('extrnal_events', function (Blueprint $table) {
			$table->increments('id');
			$table->string('event_title');
			$table->string('event_description')->nullable();
			$table->string('event_venue');
			$table->string('event_date');
			$table->string('event_time');
			$table->string('event_remarks');
			$table->tinyInteger('event_confirmation_approval')->default(0);
			$table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('extrnal_events');
	}
}
