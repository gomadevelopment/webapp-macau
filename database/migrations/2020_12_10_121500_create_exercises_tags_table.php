<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExercisesTagsTable extends Migration {

	public function up()
	{
		Schema::create('exercises_tags', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exercise_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exercises_tags');
	}
}