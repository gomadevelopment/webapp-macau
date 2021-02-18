<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamesTable extends Migration {

	public function up()
	{
		Schema::create('exames', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('student_id')->unsigned();
			$table->integer('exercise_id')->unsigned();
			$table->datetime('start_timestamp');
			$table->datetime('pause_start_timestamp');
			$table->datetime('pause_end_timestamp');
			$table->decimal('classification', 10,2)->default('0');
			$table->tinyInteger('is_finished')->default('0');
			$table->string('title', 200);
			$table->integer('exercise_category_id')->unsigned();
			$table->integer('exercise_level_id')->unsigned();
			$table->text('introduction')->nullable();
			$table->text('statement')->nullable();
			$table->text('audiovisual_desc')->nullable();
			$table->text('audio_transcript')->nullable();
			$table->tinyInteger('has_time')->default('0');
			$table->string('time', 50)->nullable();
			$table->tinyInteger('has_interruption')->default('0');
			$table->string('interruption_time', 50)->nullable();
			$table->tinyInteger('can_clone')->default('0');
			$table->tinyInteger('only_my_students')->default('0');
			$table->tinyInteger('only_after_correction')->default('0');
			$table->tinyInteger('published')->default('0');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exames');
	}
}