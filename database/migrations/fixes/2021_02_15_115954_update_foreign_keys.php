<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class UpdateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) 
		{
			$table->dropForeign('users_user_role_id_foreign');
			$table->foreign('user_role_id')->references('id')->on('user_roles')
						->onDelete('cascade')
						->onUpdate('no action');
			
			$table->dropForeign('users_university_id_foreign');
			$table->foreign('university_id')->references('id')->on('universities')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('articles', function(Blueprint $table) 
		{
			$table->dropForeign('articles_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');

			$table->dropForeign('articles_article_category_id_foreign');
			$table->foreign('article_category_id')->references('id')->on('article_categories')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('article_media', function(Blueprint $table) 
		{
			$table->dropForeign('article_media_article_id_foreign');
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('articles_tags', function(Blueprint $table) 
		{
			$table->dropForeign('articles_tags_article_id_foreign');
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('no action');
			
			$table->dropForeign('articles_tags_tag_id_foreign');
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('article_favorites', function(Blueprint $table) 
		{
			$table->dropForeign('article_favorites_article_id_foreign');
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('cascade')
						->onUpdate('no action');

			$table->dropForeign('article_favorites_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_user_1_id_foreign');
			$table->foreign('user_1_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_user_2_id_foreign');
			$table->foreign('user_2_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->dropForeign('chats_users_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('chats_users', function(Blueprint $table) {
			$table->dropForeign('chats_users_chat_id_foreign');
			$table->foreign('chat_id')->references('id')->on('chats')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->dropForeign('chat_messages_chat_id_foreign');
			$table->foreign('chat_id')->references('id')->on('chats')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('chat_messages', function(Blueprint $table) {
			$table->dropForeign('chat_messages_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->dropForeign('users_blocked_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('users_blocked', function(Blueprint $table) {
			$table->dropForeign('users_blocked_user_blocked_id_foreign');
			$table->foreign('user_blocked_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		Schema::table('student_classes', function(Blueprint $table) {
			$table->dropForeign('student_classes_teacher_id_foreign');
			$table->foreign('teacher_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->dropForeign('student_class_users_student_class_id_foreign');
			$table->foreign('student_class_id')->references('id')->on('student_classes')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('student_class_users', function(Blueprint $table) {
			$table->dropForeign('student_class_users_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});




		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_exercise_category_id_foreign');
			$table->foreign('exercise_category_id')->references('id')->on('exercise_categories')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercises', function(Blueprint $table) {
			$table->dropForeign('exercises_exercise_level_id_foreign');
			$table->foreign('exercise_level_id')->references('id')->on('exercise_level')
						->onDelete('cascade')
						->onUpdate('no action');
		});


		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->dropForeign('exercises_tags_exercise_id_foreign');
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercises_tags', function(Blueprint $table) {
			$table->dropForeign('exercises_tags_tag_id_foreign');
			$table->foreign('tag_id')->references('id')->on('tags')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercise_media', function(Blueprint $table) {
			$table->dropForeign('exercise_media_exercise_id_foreign');
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->dropForeign('exercise_favourites_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exercise_favourites', function(Blueprint $table) {
			$table->dropForeign('exercise_favourites_exercise_id_foreign');
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('cascade')
						->onUpdate('restrict');
		});

		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_type_id_foreign');
			$table->foreign('type_id')->references('id')->on('notification_types')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('notifications', function(Blueprint $table) {
			$table->dropForeign('notifications_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});

		


		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_exercise_id_foreign');
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_question_type_id_foreign');
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_question_subtype_id_foreign');
			$table->foreign('question_subtype_id')->references('id')->on('question_subtypes')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('question_subtypes', function(Blueprint $table) {
			$table->dropForeign('question_subtypes_question_type_id_foreign');
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('question_item_media', function(Blueprint $table) {
			$table->dropForeign('question_item_media_question_item_id_foreign');
			$table->foreign('question_item_id')->references('id')->on('question_items')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('question_items', function(Blueprint $table) {
			$table->dropForeign('question_items_question_id_foreign');
			$table->foreign('question_id')->references('id')->on('questions')
						->onDelete('cascade')
						->onUpdate('no action');
		});



		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_user_id_foreign');
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_student_id_foreign');
			$table->foreign('student_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_id_foreign');
			$table->foreign('exercise_id')->references('id')->on('exercises')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_category_id_foreign');
			$table->foreign('exercise_category_id')->references('id')->on('exercise_categories')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exames', function(Blueprint $table) {
			$table->dropForeign('exames_exercise_level_id_foreign');
			$table->foreign('exercise_level_id')->references('id')->on('exercise_level')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_exame_id_foreign');
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_question_type_id_foreign');
			$table->foreign('question_type_id')->references('id')->on('question_types')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_questions', function(Blueprint $table) {
			$table->dropForeign('exame_questions_question_subtype_id_foreign');
			$table->foreign('question_subtype_id')->references('id')->on('question_subtypes')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_question_items', function(Blueprint $table) {
			$table->dropForeign('exame_question_items_exame_question_id_foreign');
			$table->foreign('exame_question_id')->references('id')->on('exame_questions')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_question_item_media', function(Blueprint $table) {
			$table->dropForeign('exame_question_item_media_exame_question_item_id_foreign');
			$table->foreign('exame_question_item_id')->references('id')->on('exame_question_items')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_exame_id_foreign');
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_inquirie_id_foreign');
			$table->foreign('inquirie_id')->references('id')->on('inquiries')
						->onDelete('cascade')
						->onUpdate('no action');
		});
		Schema::table('exame_inquiries', function(Blueprint $table) {
			$table->dropForeign('exame_inquiries_student_id_foreign');
			$table->foreign('student_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('no action');
		});




		Schema::table('exame_media', function(Blueprint $table) {
			// $table->dropForeign('exame_media_exame_id_foreign');
			$table->foreign('exame_id')->references('id')->on('exames')
						->onDelete('cascade')
						->onUpdate('no action');
		});

	}

	public function down()
	{

	}
}
