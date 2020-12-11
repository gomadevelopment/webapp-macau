<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExerciseFavouritesTable extends Migration {

	public function up()
	{
		Schema::create('exercise_favourites', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('exercise_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exercise_favourites');
	}
}