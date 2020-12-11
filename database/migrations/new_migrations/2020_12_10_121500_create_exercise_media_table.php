<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExerciseMediaTable extends Migration {

	public function up()
	{
		Schema::create('exercise_media', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exercise_id')->unsigned();
			$table->string('media_url', 255);
			$table->string('media_type', 100)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exercise_media');
	}
}