<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('exames', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->foreign('exercise_category_id')->references('id')->on('exercise_categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->foreign('exercise_level_id')->references('id')->on('exercise_level')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->foreign('question_subtype_id')->references('id')->on('question_subtypes')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_question_items', function(Blueprint $table) {
			$table->foreign('exame_question_id')->references('id')->on('exame_questions')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_question_item_media', function(Blueprint $table) {
			$table->foreign('exame_question_item_id')->references('id')->on('exame_question_items')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->foreign('inquirie_id')->references('id')->on('inquiries')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{

		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_user_id_foreign');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_student_id_foreign');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_id_foreign');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_category_id_foreign');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_level_id_foreign');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_exame_id_foreign');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_question_type_id_foreign');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_question_subtype_id_foreign');
		});
		Schema::table('exame_question_items', function(Blueprint $table) {
			$table->dropForeign('exame_question_items_exame_question_id_foreign');
		});
		Schema::table('exame_question_item_media', function(Blueprint $table) {
			$table->dropForeign('exame_question_item_media_exame_question_item_id_foreign');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_exame_id_foreign');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_inquirie_id_foreign');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_student_id_foreign');
		});
	}
}