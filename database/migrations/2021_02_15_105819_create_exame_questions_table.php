<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExameQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('exame_questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('exame_id')->unsigned();
			$table->decimal('classification', 10,2)->default('0');
			$table->string('title', 255);
			$table->string('section', 255);
			$table->integer('question_type_id')->unsigned();
			$table->integer('question_subtype_id')->unsigned();
			$table->string('reference', 255)->nullable();
			$table->text('description')->nullable();
			$table->tinyInteger('teacher_correction')->default('0');
			$table->integer('avaliation_score');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('exame_questions');
	}
}