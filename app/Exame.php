<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;  

class Exame extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'exercise_id', 'start_timestamp', 'pause_start_timestamp', 'pause_end_timestamp',
        'title', 'exercise_category_id', 'exercise_level_id', 'introduction', 'duration', 'presentation_image', 'statement', 
        'audiovisual_desc', 'audio_transcript', 'has_time', 'time', 'has_interruption', 'interruption_time',
        'can_clone', 'only_my_students', 'only_after_correction'
    ];

    /**
     * Professor
     */
    public function professor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Student
     */
    public function student()
    {
        return $this->belongsTo('App\User', 'student_id');
    }

    /**
     * Exercise
     */
    public function exercise()
    {
        return $this->belongsTo('App\Exercise', 'exercise_id');
    }

    /**
     * Questions
     */
    public function questions()
    {
        return $this->hasMany('App\ExameQuestion');
    }

    /**
     * Exercise Category
     */
    public function category()
    {
        return $this->belongsTo('App\ExerciseCategory', 'exercise_category_id');
    }

    /**
     * Exercise Level
     */
    public function level()
    {
        return $this->belongsTo('App\ExerciseLevel', 'exercise_level_id');
    }

    /**
     * Medias
     */
    public function medias()
    {
        return $this->hasOne('App\ExameMedia');
    }

    /**
     * Inquiries
     */
    public function inquiries()
    {
        return $this->hasMany('App\ExameInquiry');
    }

    /**
     * Anxiety Inquiry
     */
    public function anxiety_inquiry()
    {
        return $this->hasOne('App\ExameInquiry')->where('inquirie_id', 15);
    }

    public function calculateExameTimeLeft()
    {
        $start_timestamp_unix = strtotime($this->start_timestamp); // 2021-02-17 12:19:16
        $exame_time_unix = $this->time * 60;
        $exame_datetime_limit = gmdate("Y-m-d H:i:s", $start_timestamp_unix + $exame_time_unix);

        $time_left_unix = strtotime($exame_datetime_limit) - strtotime('now');

        $hours = ($time_left_unix / 3600 % 24) < 10 ? '0'.($time_left_unix / 3600 % 24) : $time_left_unix / 3600 % 24;
        $minutes = ($time_left_unix / 60 % 60) < 10 ? '0'.($time_left_unix / 60 % 60) : $time_left_unix / 60 % 60; 
        $seconds = ($time_left_unix % 60) < 10 ? '0'.($time_left_unix % 60) : $time_left_unix % 60;

        return $hours . ':' . $minutes . ':' . $seconds;
    }

    public static function cloneStudentExame($exercise)
    {
        $student_exame = self::create([
            'user_id' => $exercise->user_id,
            'student_id' => auth()->user()->id,
            'exercise_id' => $exercise->id,
            'start_timestamp' => date('Y-m-d H:i:s'),
            'pause_start_timestamp' => null,
            'pause_end_timestamp' => null,
            'classification' => 0.00,
            'title' => $exercise->title,
            'exercise_category_id' => $exercise->exercise_category_id,
            'exercise_level_id' => $exercise->exercise_level_id,
            'introduction' => $exercise->introduction,
            'duration' => $exercise->duration,
            'statement' => $exercise->statement,
            'audiovisual_desc' => $exercise->audiovisual_desc,
            'audio_transcript' => $exercise->audio_transcript,
            'has_time' => $exercise->has_time,
            'time' => $exercise->time,
            'has_interruption' => $exercise->has_interruption,
            'interruption_time' => $exercise->interruption_time,
            'can_clone' => $exercise->can_clone,
            'only_my_students' => $exercise->only_my_students,
            'only_after_correction' => $exercise->only_after_correction,
            'published' => $exercise->published,
        ]);

        if($exercise->medias){
            $student_exame_media = ExameMedia::create([
                'exame_id' => $student_exame->id,
                'media_url' => $exercise->medias->media_url,
                'media_type' => $exercise->medias->media_type
            ]);
            // $fromPath = public_path('webapp-macau-storage/exercises/'.$exercise->id.'/medias');
            // $toPath = public_path('webapp-macau-storage/student_exames/'.auth()->user()->id.'/exame/'.$student_exame->id.'/medias');
            // File::copyDirectory($fromPath, $toPath);
        }

        foreach ($exercise->questions as $exercise_question) {
            $exame_question = ExameQuestion::create([
                'exame_id' => $student_exame->id,
                'classification' => 0.00,
                'title' => $exercise_question->title,
                'section' => $exercise_question->section,
                'question_type_id' => $exercise_question->question_type_id,
                'question_subtype_id' => $exercise_question->question_subtype_id,
                'reference' => $exercise_question->reference,
                'description' => $exercise_question->description,
                'description_image_url' => $exercise_question->description_image_url,
                'teacher_correction' => $exercise_question->teacher_correction,
                'avaliation_score' => $exercise_question->avaliation_score,
            ]);
            if($exercise_question->description_image_url){
                $fromPath = public_path('webapp-macau-storage/questions/'.$exercise_question->id.'/description_image');
                $toPath = public_path('webapp-macau-storage/student_exames/'.auth()->user()->id.'/exame/'.$student_exame->id.'/questions/'.$exame_question->id.'/description_image');
                File::copyDirectory($fromPath, $toPath);
            }
            if($exercise_question->question_items){
                foreach ($exercise_question->question_items as $exercise_question_item) {
                    $exame_question_item = ExameQuestionItem::create([
                        'exame_question_id' => $exame_question->id,
                        'text_1' => $exercise_question_item->text_1,
                        'text_2' => $exercise_question_item->text_2,
                        'category' => $exercise_question_item->category,
                        'options_correct' => $exercise_question_item->options_correct,
                        'options_answered' => '',
                        'options_number' => $exercise_question_item->options_number,
                        'options_1' => $exercise_question_item->options_1,
                        'options_2' => $exercise_question_item->options_2,
                        'options_3' => $exercise_question_item->options_3,
                        'options_4' => $exercise_question_item->options_4,
                        'options_5' => $exercise_question_item->options_5,
                        'options_6' => $exercise_question_item->options_6,
                        'options_7' => $exercise_question_item->options_7,
                        'options_8' => $exercise_question_item->options_8,
                        'options_9' => $exercise_question_item->options_9,
                        'options_10' => $exercise_question_item->options_10,
                    ]);

                    if($exercise_question_item->question_item_media){
                        $exame_question_item_media = ExameQuestionItemMedia::create([
                            'exame_question_item_id' => $exame_question_item->id,
                            'media_url' => $exercise_question_item->question_item_media->media_url,
                            'media_type' => $exercise_question_item->question_item_media->media_type
                        ]);
                        $fromPath = public_path('webapp-macau-storage/questions/'.$exercise_question->id.'/question_item/' . $exercise_question_item->id);
                        $toPath = public_path('webapp-macau-storage/student_exames/'.auth()->user()->id.'/exame/'.$student_exame->id.'/questions/'.$exame_question->id.'/question_item/'.$exame_question_item->id);
                        File::copyDirectory($fromPath, $toPath);
                    }
                }
            }
        }
        return $student_exame;
    }

    /**
     * STUDENT
     */
    public function saveExerciseByStudent($exercise, $inputs)
    {
        $questions = $this->questions()->get();

        // Save Inquiries
        foreach($inputs['inquiries'] as $inquiry_id => $inquiry_value){
            ExameInquiry::create([
                'exame_id' => $this->id,
                'inquirie_id' => $inquiry_id,
                'student_id' => $this->student_id,
                'value' => $inquiry_value
            ]);
        }

        $exercise_student_score = 0;
        $exercise_sum_score_points = $questions->sum('avaliation_score');
        $teacher_correction = false;
        foreach ($questions as $question) {
            if($question->teacher_correction && $question->avaliation_score != 0){
                $teacher_correction = true;
                continue;
            }
            switch ($question->question_subtype_id){
                // Information
                case 1:
                    // $this->informationQuestionType($inputs);
                    $question->save();
                    break;
                // Correspondence - Images
                case 2:
                    $question->classification = $this->correspondenceImagesCorrection($question, $inputs[$question->id . '_correspondence_images']);
                    $question->save();
                    break;
                // Correspondence - Audios
                case 3:
                    $question->classification = $this->correspondenceAudiosCorrection($question, $inputs[$question->id . '_correspondence_audios']);
                    $question->save();
                    break;
                // Correspondence - Categories
                case 4:
                    $question->classification = $this->correspondenceCategoriesCorrection($question, $inputs[$question->id . '_correspondence_categories']);
                    $question->save();
                    break;
                // Fill Options - Shuffle
                case 5:
                    $question->classification = $this->fillOptionsShuffleCorrection($question, $inputs[$question->id . '_fill_options_shuffle']);
                    $question->save();
                    break;
                // Fill Options - Text Words
                case 6:
                    $question->classification = $this->fillOptionsTextWordsCorrection($question, $inputs[$question->id . '_fill_options_words']);
                    $question->save();
                    break;
                // Fill Options - Writing
                case 18:
                    $question->classification = $this->fillOptionsWritingCorrection($question, $inputs[$question->id . '_fill_options_writing']);
                    $question->save();
                    break;
                // True or False
                case 7:
                    $question->classification = $this->trueOrFalseCorrection($question, $inputs[$question->id . '_true_or_false']);
                    $question->save();
                    break;
                // Multiple Choice - Questions
                case 8:
                    $question->classification = $this->multipleChoiceQuestionsCorrection($question, $inputs[$question->id . '_multiple_choice_questions']);
                    $question->save();
                    break;
                // Multiple Choice - Intruder
                case 9:
                    $question->classification = $this->multipleChoiceIntruderCorrection($question, $inputs[$question->id . '_multiple_choice_intruder']);
                    $question->save();
                    break;
                // Free Questions
                case 10:
                    $question->classification = $this->freeQuestionCorrection($question, $inputs[$question->id . '_free_question']);
                    $question->save();
                    break;
                // Differences - Differences
                case 11:
                    $question->classification = $this->differencesDifferencesCorrection($question, $inputs[$question->id . '_differences']);
                    $question->save();
                    break;
                // Differences - Differences
                case 19:
                    $question->classification = $this->differencesFindWordsCorrection($question, $inputs[$question->id . '_differences_find_words']);
                    $question->save();
                    break;
                // Statement Correction
                case 12:
                    $question->classification = $this->statementCorrectionCorrection($question, $inputs[$question->id . '_statement_correction']);
                    $question->save();
                    break;
                // Automatic Content
                case 13:
                    $question->classification = $this->automaticContentCorrection($question, $inputs[$question->id . '_automatic_content']);
                    $question->save();
                    break;
                // Assortment - Sentences
                case 14:
                    $question->classification = $this->assortmentSentencesCorrection($question, $inputs[$question->id . '_assortment_sentences']);
                    $question->save();
                    break;
                // Assortment - Words
                case 15:
                    $question->classification = $this->assortmentWordsCorrection($question, $inputs[$question->id . '_assortment_words']);
                    $question->save();
                    break;
                // Assortment - Images
                case 16:
                    $question->classification = $this->assortmentImagesCorrection($question, $inputs[$question->id . '_assortment_images']);
                    $question->save();
                    break;
                // Vowels
                case 17:
                    $question->classification = $this->vowelsCorrection($question, $inputs[$question->id . '_vowels']);
                    $question->save();
                    break;
                default:
                    break;
            }
        }

        $exercise_student_score = $questions->sum('classification');

        $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);

        $this->classification = $exercise_student_score;
        $this->is_finished = 1;
        $this->is_revised = $teacher_correction ? 0 : 1;
        $this->finish_date = date('Y-m-d');
        $this->save();

        if($teacher_correction){
            if($this->professor->notification_type_2){
                Notification::create([
                    'title' => 'Novo Exame requer avaliação.',
                    'text' => 'O aluno ' . auth()->user()->username . ' requere avaliação do Exame "' . $this->title . '".',
                    'url' => '/exercicios/corrigir/'.$this->id.'/aluno/'.auth()->user()->id,
                    'param1_text' => 'exame_id',
                    'param1' => $this->id,
                    'param2_text' => 'aluno',
                    'param2' => auth()->user()->id,
                    'type_id' => 2,
                    'user_id' => $this->user_id,
                    'active' => 1
                ]);
            }
        }

        if(!$questions->count()){
            return [0, $teacher_correction, 'no_questions'];
        }

        return [$score_perc, $teacher_correction];
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function correspondenceImagesCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if($question_item->question_item_media && isset($answer_array[$question_item->question_item_media->id])){
                $question_item->options_answered = $answer_array[$question_item->question_item_media->id];
            }
            else{
                $question_item->options_answered = '';
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $solution_array[$question_item->question_item_media->id] = $question_item->id;
        }

        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function correspondenceAudiosCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if($question_item->question_item_media && isset($answer_array[$question_item->question_item_media->id])){
                $question_item->options_answered = $answer_array[$question_item->question_item_media->id];
            }
            else{
                $question_item->options_answered = '';
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $solution_array[$question_item->question_item_media->id] = $question_item->id;
        }

        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER DOESN'T MATTER (shuffled options)
     */
    public function correspondenceCategoriesCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $solution_array[$question_item->id][] = $question_item->$option;
            }
        }

        return self::partialCorrectionDeepLevel_1_WithShuffle($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER MATTERS
     */
    public function fillOptionsShuffleCorrection($question, $answer_array)
    {
        // dd($answer_array);
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if(!isset($answer_array[$question_item->id])){
                $question_item->save();
                continue;
            }
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
             if(!isset($answer_array[$question_item->id])){
                $question_item->save();
                continue;
            }
            $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
            preg_match_all($regex, $question_item->text_1, $matches);
            foreach($matches[1] as $word_match){
                $solution_array[$question_item->id][] = $word_match;
            }
        }

        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER MATTERS
     */
    public function fillOptionsTextWordsCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                $response = $response == null ? '' : $response;
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $solution_array[$question_item->id][] = explode('|', $question_item->$option)[0];
            }
        }

        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER MATTERS
     */
    public function fillOptionsWritingCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_%-])\s*%>/";
            preg_match_all($regex, $question_item->text_1, $matches);
            foreach($matches[1] as $word_match){
                $solution_array[$question_item->id][] = $word_match;
            }
        }

        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function trueOrFalseCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            foreach($answer_array as $question_item_id => $question_answer){
                if($question_item_id == $question_item->id){
                    $question_item->options_answered = $question_answer == null ? '' : $question_answer;
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $solution_array[$question_item->id] = $question_item->options_correct;
        }

        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function multipleChoiceQuestionsCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if(sizeof($answer_array[$question_item->id]) == 1 && !$answer_array[$question_item->id][0]){
                $question_item->options_answered = '';
            }
            else{
                $question_item->options_answered = implode(', ', $answer_array[$question_item->id]);
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $solution_array[$question_item->id] = explode(', ', $question_item->options_correct);
        }

        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function multipleChoiceIntruderCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id] == null ? '' : $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        $number_of_wrong_alineas = 0;
        foreach ($question->question_items as $question_item) {
            $options_correct = explode(',', $question_item->options_correct);
            if(!in_array($answer_array[$question_item->id], $options_correct)){
                $number_of_wrong_alineas++;
            }
        }

        if($number_of_wrong_alineas == 0){
            return $question->avaliation_score;
        }

        $number_of_alineas = sizeof($answer_array);
        $points_per_alinea = sizeof($answer_array) == 0 ? 0 : ($question->avaliation_score / $number_of_alineas);
        $number_of_correct_alineas = sizeof($answer_array) - $number_of_wrong_alineas;
        $partial_score = (int)round($points_per_alinea * $number_of_correct_alineas);

        return $partial_score;
    }

    public function freeQuestionCorrection($question, $answer_array)
    {
        // STAND BY
        return 0;
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function differencesDifferencesCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach($question->question_items as $question_item){
            $solution_array[$question_item->id] = $question_item->text_2;
        }
        
        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function differencesFindWordsCorrection($question, $answer_array)
    {
        // dd($answer_array);
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(!$response){
                    continue;
                }
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach($question->question_items as $question_item){
            $solution_array[$question_item->id] = explode(', ', $question_item->options_correct);
        }
        // dd($answer_array, $solution_array);
        // dd('STOP', $answer_array, $solution_array);
        return self::partialCorrectionDeepLevel_1_WithShuffle($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function statementCorrectionCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach($question->question_items as $question_item){
            $solution_array[$question_item->id] = $question_item->text_2;
        }

        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function automaticContentCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach($question->question_items as $question_item){
            $solution_array[$question_item->id] = $question_item->text_1;
        }

        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER MATTERS
     */
    public function assortmentSentencesCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $solution_array[$question_item->id][] = $question_item->$option;
            }
        }
        
        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER MATTERS
     */
    public function assortmentWordsCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . '|';
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $solution_array[$question_item->id][] = $question_item->$option;
            }
        }

        return self::partialCorrectionDeepLevel_1($question, $answer_array, $solution_array);
    }

    /**
     *  question_items with no sub-options/sub-arrays
     */
    public function assortmentImagesCorrection($question, $answer_array)
    {
        // Save Answers given
        $count = 0;
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$count];
            $question_item->save();
            $count++;
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            $solution_array[] = $question_item->id;
        }
        
        return self::partialCorrectionDeepLevel_0($question, $answer_array, $solution_array);
    }

    /**
     *  question_items that have sub-options/sub-arrays
     *  ORDER DOESN'T MATTER (shuffled options)
     */
    public function vowelsCorrection($question, $answer_array)
    {
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $search_string = $question_item->id . ','.$i;
                foreach($answer_array as $label_key => $sub_array){
                    foreach($sub_array as $question_item_response_id){
                        if($search_string == $question_item_response_id){
                            if($i == ($question_item->options_number-1)) {
                                $question_item->options_answered .= $label_key;
                            }
                            else{
                                $question_item->options_answered .= $label_key . '|';
                            }
                        }
                    }
                }
            }
            $question_item->save();
        }

        // Solution
        $solution_array = [];
        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $unique_vowels[] = $question_item->$option;
            }
        }
        foreach(array_unique($unique_vowels) as $vowel){
            $solution_array[$vowel] = [];
        }

        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $solution_array[$question_item->$option][] = $question_item->id . ',' . $i;
            }
        }

        return self::partialCorrectionDeepLevel_1_WithShuffle($question, $answer_array, $solution_array);
    }


    /*********************
        Partial Correction for question_items with no sub-options/sub-arrays
    */    
    public function partialCorrectionDeepLevel_0($question, $answer_array, $solution_array)
    {
        // Partial Score Calculation
        if($answer_array == $solution_array){
            return $question->avaliation_score;
        }

        $number_of_alineas = sizeof($solution_array);
        $points_per_alinea = sizeof($solution_array) == 0 ? 0 : ($question->avaliation_score / $number_of_alineas);
        $number_of_correct_alineas = sizeof($solution_array) - sizeof(array_diff_assoc($answer_array, $solution_array));
        $partial_score = (int)round($points_per_alinea * $number_of_correct_alineas);

        return $partial_score;
    }

    /*********************
        Partial Correction for question_items that have sub-options/sub-arrays
        ORDER MATTERS
    */    
    public function partialCorrectionDeepLevel_1($question, $answer_array, $solution_array)
    {
        // Partial Score Calculation
        $number_of_alineas = 0;
        foreach($solution_array as $key => &$sub_array){
            $number_of_alineas += sizeof($sub_array);
        }

        $number_of_wrong_alineas = 0;
        foreach($solution_array as $sol_key => &$sol_sub_array){
            $number_of_wrong_alineas += sizeof(array_diff_assoc($sol_sub_array, $answer_array[$sol_key]));
        }

        if($number_of_wrong_alineas == 0){
            return $question->avaliation_score;
        }
        
        $points_per_alinea = $number_of_alineas == 0 ? 0 : ($question->avaliation_score / $number_of_alineas);
        $number_of_correct_alineas = $number_of_alineas - $number_of_wrong_alineas;
        $partial_score = (int)round($points_per_alinea * $number_of_correct_alineas);

        return $partial_score;
    }

    /*********************
        Partial Correction for question_items that have sub-options/sub-arrays
        ORDER DOESN'T MATTER (shuffled options)
    */    
    public function partialCorrectionDeepLevel_1_WithShuffle($question, $answer_array, $solution_array)
    {
        // Partial Score Calculation
        $number_of_alineas = 0;
        foreach($solution_array as $key => &$sub_array){
            $number_of_alineas += sizeof($sub_array);
        }

        $number_of_wrong_alineas = 0;
        if($question->question_subtype_id == 19){
            foreach($solution_array as $sol_key => &$sol_sub_array){
                foreach($sol_sub_array as $sol_sub_array_value){
                    if(!in_array($sol_sub_array_value, $answer_array[$sol_key])){
                        $number_of_wrong_alineas++;
                    }
                }
            }
        }
        else{
            foreach($answer_array as $ans_key => &$ans_sub_array){
                foreach($ans_sub_array as $ans_sub_array_value){
                    if($question->question_subtype_id == 19 && !$ans_sub_array_value){
                        continue;
                    }
                    if(!in_array($ans_sub_array_value, $solution_array[$ans_key])){
                        $number_of_wrong_alineas++;
                    }
                }
            }
        }

        if($number_of_wrong_alineas == 0){
            return $question->avaliation_score;
        }
        
        $points_per_alinea = $number_of_alineas == 0 ? 0 : ($question->avaliation_score / $number_of_alineas);
        $number_of_correct_alineas = $number_of_alineas - $number_of_wrong_alineas;
        $partial_score = (int)round($points_per_alinea * $number_of_correct_alineas);

        $partial_score = $partial_score < 0 ? 0 : $partial_score;

        return $partial_score;
    }
    
    /*********************
        Professor Free Questions correction
    */    
    public function professorExameCorrection($inputs)
    {
        foreach($inputs['free_question_correction_scores'] as $question_id => $question_score){
            $question = ExameQuestion::find($question_id);
            $question->classification = $question_score;
            $question->save();
        }

        $this->is_revised = 1;
        $this->save();

        if($this->student->notification_type_2){
            Notification::create([
                'title' => 'Exame corrigido',
                'text' => 'O seu exame "'.$this->title.'" foi corrigido. Já o pode rever com nota total.',
                'url' => '/exercicios/realizar/'.$this->exercise->id,
                'param1_text' => 'exercise_id',
                'param1' => $this->exercise->id,
                'param2_text' => '',
                'param2' => '',
                'type_id' => 2,
                'user_id' => $this->student_id,
                'active' => 1
            ]);
        }
            
        
    }

    /*
        Performance Filters
    */
    public static function applyPerformanceFilters($filters = [], $by_student_or_class = 'by_student')
    {
        // dd($filters, $professors_or_students);
        $professor_students_ids = [];
        if($by_student_or_class == 'by_student'){
            $query = self::with(['anxiety_inquiry', 'exercise', 'questions', 'inquiries'])
                        ->where('student_id', $filters['user_id'])
                        ->where('is_finished', 1)
                        ->orderBy('created_at', 'asc');
            
            // Professor is viewing student profile - only sees exames made by that professor
            if($filters['user_id'] != auth()->user()->id && auth()->user()->isProfessor() && auth()->user()->isActive()){
                $query = $query->where('user_id', auth()->user()->id);
            }
        }
        else{
            $professor_students_ids = auth()->user()
                                ->getProfessorStudents($filters['class_id'] ? $filters['class_id'] : null)
                                ->pluck('id')
                                ->toArray();
            // dd($professor_students_ids);
            $query = self::with(['anxiety_inquiry', 'exercise', 'questions', 'inquiries'])
                        // ->where('id', '<', 242)
                        ->where('user_id', auth()->user()->id)
                        ->whereIn('student_id', $professor_students_ids)
                        ->where('is_finished', 1)
                        ->orderBy('created_at', 'asc');
        }

        // Levels Filter
        if(isset($filters['performance_filters_levels']) && $filters['performance_filters_levels']){
            $query = $query->whereIn('exercise_level_id', $filters['performance_filters_levels']);
        }

        // settings_professors_filter_approval

        // Categories Filter
        if(isset($filters['performance_filters_categories']) && $filters['performance_filters_categories']){
            $query = $query->whereIn('exercise_category_id', $filters['performance_filters_categories']);
        }

        // Question Subtypes Filter
        if(isset($filters['performance_filters_question_types']) && $filters['performance_filters_question_types']){
            $query = $query->whereHas('questions', function($q) use($filters) {
                        $q->whereHas('question_subtype', function($q2) use($filters) {
                            return $q2->whereIn('question_subtypes.id', $filters['performance_filters_question_types']);
                        });
            });
        }

        // Start date - finish date
        if (isset($filters['performance_filters_start_date']) && $filters['performance_filters_start_date']) {
            $start_date = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$filters['performance_filters_start_date']);
            $query->where('finish_date', '>=', $start_date);
        }
        
        // End date - finish date
        if (isset($filters['performance_filters_end_date']) && $filters['performance_filters_end_date']) {
            $end_date = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$filters['performance_filters_end_date']);
            $query->where('finish_date', '<=', $end_date);
        }

        return self::performanceCalculation(
            $by_student_or_class == 'by_class' ? $query->get()->unique('exercise_id') : $query->get(), 
            $by_student_or_class == 'by_class' ? $professor_students_ids : []);
    }

    // PERFORMANCE CALCULATION
    public static function performanceCalculation($exames, $professor_students_ids)
    {
        $count = 0;
        $previous_exame = null;
        $exclude_exames = [];
        $length = count($exames);
        $fixed_exames = [];
        foreach ($exames as $exame) {

            // Calculate Exame Inquiries Median
            foreach ($exame->inquiries as $inquiry) {
                if($inquiry->inquirie_id == 15){
                    break;
                }
                if($previous_exame){
                    foreach ($previous_exame->inquiries as $previous_inquiry) {
                        if($inquiry->inquirie_id == $previous_inquiry->inquirie_id){
                            
                            $inquiry->accumulated_value = ($inquiry->value + $previous_inquiry->accumulated_value);
                            $inquiry->median = round(($inquiry->value + $previous_inquiry->accumulated_value) / ($count + 1), 2);
                            if($count == 2 && $inquiry->inquirie_id == 3){
                                // dd($inquiry, $previous_inquiry);
                            }
                        }
                    }
                }
                else{
                    $inquiry->median = $inquiry->value;
                    $inquiry->accumulated_value = $inquiry->value;
                }
            }

            if($count == 0){
                if(!empty($professor_students_ids)){
                    $all_exames_made_by_student = 
                                self::with('anxiety_inquiry')
                                    ->whereIn('student_id', $professor_students_ids)
                                    ->where('user_id', auth()->user()->id)
                                    ->where('exercise_id', $exame->exercise_id)
                                    ->orderBy('created_at', 'asc')
                                    ->get();
                    // dd($exame->id, $all_exames_made_by_student);
                    $all_exames_number = $all_exames_made_by_student->count();
                    // $all_exames_performance = 0;
                    $performance_anxiety_factor_level = $exame->exercise->level->performance_anxiety_factor
                        ? ($exame->exercise->level->performance_anxiety_factor / 5)
                        : 2;
                    $anxiety_indice = 0;
                    $exame['classification_median'] = 0;
                    $exame['anxiety_median'] = 0;
                    $exame['accumulated_classification'] = 0;
                    $exame['performance'] = 0;
                    foreach ($all_exames_made_by_student as $exame2) {
                        $anxiety_indice += !isset($exame2->anxiety_inquiry) || $exame2->anxiety_inquiry->value == 1 ? 0 : $exame2->anxiety_inquiry->value * $performance_anxiety_factor_level;
                        $exame['classification_median'] += $exame2->questions->sum('avaliation_score') == 0 ? 0 : round(($exame2->questions->sum('classification') / $exame2->questions->sum('avaliation_score')) * 100);
                        $exame['anxiety_median'] += !isset($exame2->anxiety_inquiry) ? 1 : $exame2->anxiety_inquiry->value;
                        $exame['accumulated_classification'] += $exame2->questions->sum('avaliation_score') == 0 ? 0 : round(($exame2->questions->sum('classification') / $exame2->questions->sum('avaliation_score')) * 100);
                        $exame['performance'] += $exame['classification_median'] - $anxiety_indice;

                    }

                    $anxiety_indice = $anxiety_indice / $all_exames_number;
                    $exame['classification_median'] = (string)($exame['classification_median'] / $all_exames_number);
                    $exame['anxiety_median'] = (string)($exame['anxiety_median'] / $all_exames_number);
                    $exame['accumulated_classification'] = (string)($exame['accumulated_classification'] / $all_exames_number);
                    $exame['performance'] = 
                        $exame['classification_median'] == 0.00
                        ? (string)$exame['classification_median']
                        : (string)($exame['classification_median'] - $anxiety_indice);
                    
                    $exame['performance'] = $exame['performance'] < 0 ? 0 : $exame['performance'];
                    
                    // dd($exame, $all_exames_made_by_student, $anxiety_indice);
                    // $exclude_exames[] = $exame2->id;
                    $previous_exame = $exame;
                }
                else{
                    // Indice de Ansiedade - desconta % em função do nível do Exercício
                    $performance_anxiety_factor_level = $exame->exercise->level->performance_anxiety_factor
                        ? ($exame->exercise->level->performance_anxiety_factor / 5)
                        : 2;
                    $anxiety_indice = !isset($exame->anxiety_inquiry) || $exame->anxiety_inquiry->value == 1 ? 0 : $exame->anxiety_inquiry->value * $performance_anxiety_factor_level;
                    $exame['classification_median'] = $exame->questions->sum('avaliation_score') == 0 ? 0 : round(($exame->questions->sum('classification') / $exame->questions->sum('avaliation_score')) * 100);
                    $exame['anxiety_median'] = !isset($exame->anxiety_inquiry) ? 1 : $exame->anxiety_inquiry->value;
                    $exame['accumulated_classification'] = $exame->questions->sum('avaliation_score') == 0 ? 0 : round(($exame->questions->sum('classification') / $exame->questions->sum('avaliation_score')) * 100);;
                    $exame['performance'] = 
                        $exame['classification_median'] == 0.00
                        ? (string)$exame['classification_median']
                        : (string)($exame['classification_median'] - $anxiety_indice);
                    $exame['performance'] = $exame['performance'] < 0 ? 0 : $exame['performance'];
                    $previous_exame = $exame;
                }
                
            }
            else{
                if(!empty($professor_students_ids)){
                    $all_exames_made_by_student = 
                                self::with('anxiety_inquiry')
                                    ->whereNotIn('id', $exclude_exames)
                                    ->whereIn('student_id', $professor_students_ids)
                                    ->where('user_id', auth()->user()->id)
                                    ->where('exercise_id', $exame->exercise_id)
                                    ->orderBy('created_at', 'asc')
                                    ->get();

                    $all_exames_number = $all_exames_made_by_student->count();
                    $performance_anxiety_factor_level = $exame->exercise->level->performance_anxiety_factor
                        ? ($exame->exercise->level->performance_anxiety_factor / 5)
                        : 2;
                    $anxiety_indice = 0;
                    $exame['classification_median'] = 0;
                    $exame['anxiety_median'] = 0;
                    $exame['accumulated_classification'] = 0;
                    $exame['performance'] = 0;
                    foreach ($all_exames_made_by_student as $exame2) {
                        $anxiety_indice += !isset($exame2->anxiety_inquiry) ||  $exame2->anxiety_inquiry->value == 1 ? 0 : $exame2->anxiety_inquiry->value * $performance_anxiety_factor_level;
                        $exame['anxiety_median'] += !isset($exame2->anxiety_inquiry) ? 1 : $exame2->anxiety_inquiry->value;
                        $exame['accumulated_classification'] += $exame2->questions->sum('avaliation_score') == 0 ? 0 : round(($exame2->questions->sum('classification') / $exame2->questions->sum('avaliation_score')) * 100);
                        $exame['performance'] += $exame['classification_median'] - $anxiety_indice;

                    }
                    // dd($exame['performance']);
                    $anxiety_indice = $anxiety_indice / $all_exames_number; //
                    $exame['classification_median'] = (string)($exame['accumulated_classification'] / $all_exames_number); //
                    $exame['anxiety_median'] = (string)($exame['anxiety_median'] / $all_exames_number); //
                    $exame['accumulated_classification'] = (string)($previous_exame->accumulated_classification + $exame['classification_median']);
                    
                    
                    $performance = $exame->accumulated_classification == 0.00 
                        ? (string)$exame->accumulated_classification 
                        : (string)round(($exame->accumulated_classification / ($count+1)), 2);
                    
                    $exame['performance'] = (string)($performance - $anxiety_indice);
                    $exame['performance'] = $exame['performance'] < 0 ? 0 : $exame['performance'];

                    $previous_exame = $exame;
                }
                else{
                    $performance_anxiety_factor_level = $exame->exercise->level->performance_anxiety_factor
                        ? ($exame->exercise->level->performance_anxiety_factor / 5)
                        : 2;
                    $exame['classification_median'] = $exame->questions->sum('avaliation_score') == 0 ? 0 : round(($exame->questions->sum('classification') / $exame->questions->sum('avaliation_score')) * 100);;
                    $exame['anxiety_median'] = !isset($exame->anxiety_inquiry) ? 1 : $exame->anxiety_inquiry->value;
                    $exame['accumulated_classification'] = $previous_exame->accumulated_classification + $exame['classification_median'];
                    $performance = 
                        $exame->accumulated_classification == 0.00 
                        ? (string)$exame->accumulated_classification 
                        : (string)round(($exame->accumulated_classification / ($count+1)), 2);
                    // Indice de Ansiedade - desconta até 10%
                    $anxiety_indice = !isset($exame->anxiety_inquiry) || $exame->anxiety_inquiry->value == 1 ? 0 : $exame->anxiety_inquiry->value * $performance_anxiety_factor_level; //
                    $exame['performance'] = (string)($performance - $anxiety_indice);
                    $exame['performance'] = $exame['performance'] < 0 ? 0 : $exame['performance'];

                    $previous_exame = $exame;
                }
            }
            $count++;
            $fixed_exames[] = $exame;
        }

        return collect($fixed_exames);
    }
}
