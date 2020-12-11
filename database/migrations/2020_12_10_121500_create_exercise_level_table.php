<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExerciseLevelTable extends Migration {

	public function up()
	{
		Schema::create('exercise_level', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exercise_level');
	}
}