<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExerciseCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('exercise_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 200);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exercise_categories');
	}
}