<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionSubtypesTable extends Migration {

	public function up()
	{
		Schema::create('question_subtypes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('question_type_id')->unsigned();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('question_subtypes');
	}
}