<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('participants', function (Blueprint $table) {
			$table->increments('id');
			$table->string('participant_name');
			$table->string('participant_contact')->nullable();
			$table->string('participant_department')->nullable();
			$table->string('participant_designation')->nullable();
			$table->string('participant_email')->nullable();
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {

		Schema::dropIfExists('participants');
	}
}