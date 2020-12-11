<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{

		Schema::table('exercises', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->foreign('exercise_category_id')->references('id')->on('exercise_categories')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->foreign('exercise_level_id')->references('id')->on('exercise_level')
						->onDelete('no action')
						->onUpdate('no action');
		});


		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercise_media', function(Blueprint $table) {
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{

		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_user_id_foreign');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_exercise_category_id_foreign');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_exercise_level_id_foreign');
		});
		
		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->dropForeign('exercises_tags_exercise_id_foreign');
		});
		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->dropForeign('exercises_tags_tag_id_foreign');
		});
		Schema::table('exercise_media', function(Blueprint $table) {
			$table->dropForeign('exercise_media_exercise_id_foreign');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->dropForeign('exercise_favourites_user_id_foreign');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->dropForeign('exercise_favourites_exercise_id_foreign');
		});
	}
}