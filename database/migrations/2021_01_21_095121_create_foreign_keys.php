<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('questions', function(Blueprint $table) {
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->foreign('question_subtype_id')->references('id')->on('question_subtypes')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('question_subtypes', function(Blueprint $table) {
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('question_item_media', function(Blueprint $table) {
			$table->foreign('question_item_id')->references('id')->on('question_items')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('question_items', function(Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('questions')
						->onDelete('no action')
						->onUpdate('no action');
		});
		
	}

	public function down()
	{
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_exercise_id_foreign');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_question_type_id_foreign');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_question_subtype_id_foreign');
		});
		Schema::table('question_subtypes', function(Blueprint $table) {
			$table->dropForeign('question_subtypes_question_type_id_foreign');
		});
		Schema::table('question_item_media', function(Blueprint $table) {
			$table->dropForeign('question_item_media_question_item_id_foreign');
		});
		Schema::table('question_items', function(Blueprint $table) {
			$table->dropForeign('question_items_question_id_foreign');
		});
				
	}
}