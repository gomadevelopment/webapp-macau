<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;  

class Exame extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'exercise_id', 'start_timestamp', 'pause_start_timestamp', 'pause_end_timestamp',
        'title', 'exercise_category_id', 'exercise_level_id', 'introduction', 'statement', 
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

    public function calculateExameTimeLeft()
    {
        $secondstart_timestamp_unix = strtotime($this->start_timestamp); // 2021-02-17 12:19:16
        $exame_time_unix = $this->time * 60;
        $exame_datetime_limit = gmdate("Y-m-d H:i:s", $secondstart_timestamp_unix + $exame_time_unix);

        $time_left_unix = strtotime($exame_datetime_limit) - strtotime('now');

        $hours = ($time_left_unix / 3600 % 24) < 10 ? '0'.($time_left_unix / 3600 % 24) : $time_left_unix / 3600 % 24;
        $minutes = ($time_left_unix / 60 % 60) < 10 ? '0'.($time_left_unix / 60 % 60) : $time_left_unix / 60 % 60; 
        $seconds = ($time_left_unix % 60) < 10 ? '0'.($time_left_unix % 60) : $time_left_unix % 60;

        // dd($hours, $minutes, $seconds);
        
        // $minutesinutes_left = (strtotime($exame_datetime_limit) - strtotime('now')) / 60;

        return $hours . ':' . $minutes . ':' . $seconds;
    }

    public static function cloneStudentExame($exercise)
    {
        // dd(date('Y-m-d H:i:s'));
        $secondstudent_exame = self::create([
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
            $secondstudent_exame_media = ExameMedia::create([
                'exame_id' => $secondstudent_exame->id,
                'media_url' => $exercise->medias->media_url,
                'media_type' => $exercise->medias->media_type
            ]);
            $fromPath = public_path('webapp-macau-storage/exercises/'.$exercise->id.'/medias');
            $toPath = public_path('webapp-macau-storage/student_exames/'.auth()->user()->id.'/exame/'.$secondstudent_exame->id.'/medias');
            File::copyDirectory($fromPath, $toPath);
        }

        foreach ($exercise->questions as $exercise_question) {
            $exame_question = ExameQuestion::create([
                'exame_id' => $secondstudent_exame->id,
                'classification' => 0.00,
                'title' => $exercise_question->title,
                'section' => $exercise_question->section,
                'question_type_id' => $exercise_question->question_type_id,
                'question_subtype_id' => $exercise_question->question_subtype_id,
                'reference' => $exercise_question->reference,
                'description' => $exercise_question->description,
                'teacher_correction' => $exercise_question->teacher_correction,
                'avaliation_score' => $exercise_question->avaliation_score,
            ]);
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
                        $toPath = public_path('webapp-macau-storage/student_exames/'.auth()->user()->id.'/exame/'.$secondstudent_exame->id.'/questions/'.$exame_question->id.'/question_item/'.$exame_question_item->id);
                        File::copyDirectory($fromPath, $toPath);
                    }
                }
            }
        }
        return $secondstudent_exame;
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
            if($question->teacher_correction){
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
                // Differences
                case 11:
                    $question->classification = $this->differencesCorrection($question, $inputs[$question->id . '_differences']);
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
        // dd($exercise_sum_score_points, $exercise_student_score);
        $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);

        $this->classification = $exercise_student_score;
        $this->is_finished = 1;
        $this->save();

        if(!$questions->count()){
            return [0, $teacher_correction, 'no_questions'];
        }

        return [$score_perc, $teacher_correction];
    }

    public function correspondenceImagesCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }

        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if($question_item->question_item_media && isset($answer_array[$question_item->question_item_media->id])){
                $question_item->options_answered = $answer_array[$question_item->question_item_media->id];
            }
            else{
                $question_item->options_answered = null;
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            $secondsolution_array[$question_item->question_item_media->id] = $question_item->id;
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function correspondenceAudiosCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }

        // Save Answers given
        foreach ($question->question_items as $question_item) {
            if($question_item->question_item_media && isset($answer_array[$question_item->question_item_media->id])){
                $question_item->options_answered = $answer_array[$question_item->question_item_media->id];
            }
            else{
                $question_item->options_answered = null;
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            $secondsolution_array[$question_item->question_item_media->id] = $question_item->id;
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function correspondenceCategoriesCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        foreach($answer_array as $answer_sub_array){
            if (array_search(null, $answer_array) !== false || array_search(null, $answer_sub_array) !== false){
                // dd('WRONG - SCORE 0', $answer_array);
                return 0;
            }
        }

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
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $secondsolution_array[$question_item->id][] = $question_item->$option;
            }
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);
        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function fillOptionsShuffleCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        foreach($answer_array as $answer_sub_array){
            if (array_search(null, $answer_array) !== false || array_search(null, $answer_sub_array) !== false){
                // dd('WRONG - SCORE 0', $answer_array);
                return 0;
            }
        }

        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . ', ';
                }
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            $regex = "/<%\s*([A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*)\s*%>/";
            preg_match_all($regex, $question_item->text_1, $minutesatches);
            foreach($minutesatches[1] as $word_match){
                $secondsolution_array[$question_item->id][] = $word_match;
            }
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);
        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function fillOptionsTextWordsCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        foreach($answer_array as $answer_sub_array){
            if (array_search(null, $answer_array) !== false || array_search(null, $answer_sub_array) !== false){
                // dd('WRONG - SCORE 0', $answer_array);
                return 0;
            }
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $numItems = count($answer_array[$question_item->id]);
            $i = 0;
            foreach($answer_array[$question_item->id] as $response){
                if(++$i === $numItems) {
                    $question_item->options_answered .= $response;
                }
                else{
                    $question_item->options_answered .= $response . ', ';
                }
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $secondsolution_array[$question_item->id][] = explode('|', $question_item->$option)[0];
            }
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);
        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function trueOrFalseCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        foreach($answer_array as $answer_sub_array){
            if (array_search(null, $answer_array) !== false || array_search(null, $answer_sub_array) !== false){
                // dd('WRONG - SCORE 0', $answer_array);
                return 0;
            }
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            foreach($answer_array as $label_key => $secondsub_array){
                foreach($secondsub_array as $question_item_response_id){
                    if($question_item->id == $question_item_response_id){
                        $question_item->options_answered = $label_key;
                    }
                }
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach($answer_array as $key => $secondsub_array){
            $secondsolution_array[$key] = [];
        }
        foreach ($question->question_items as $question_item) {
            $secondsolution_array[$question_item->options_correct][] = (string)$question_item->id;
        }
        foreach($answer_array as $key => &$secondsub_array){
            sort($secondsub_array);
        }
        foreach($secondsolution_array as $key => &$secondsub_array){
            sort($secondsub_array);
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);
        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function multipleChoiceQuestionsCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            $options_correct = explode(',', $question_item->options_correct);
            if(!in_array($answer_array[$question_item->id], $options_correct)){
                return 0;
            }
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);

        return $question->avaliation_score;
    }

    public function multipleChoiceIntruderCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            $options_correct = explode(',', $question_item->options_correct);
            if(!in_array($answer_array[$question_item->id], $options_correct)){
                return 0;
            }
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);

        return $question->avaliation_score;
    }

    public function freeQuestionCorrection($question, $answer_array)
    {
        // STAND BY
    }

    public function differencesCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach($question->question_items as $question_item){
            $secondsolution_array[$question_item->id] = $question_item->text_2;
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function statementCorrectionCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach($question->question_items as $question_item){
            $secondsolution_array[$question_item->id] = $question_item->text_2;
        }
        // dd($answer_array, $secondsolution_array, $answer_array == $secondsolution_array, $question_item);

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function automaticContentCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            $question_item->options_answered = $answer_array[$question_item->id];
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach($question->question_items as $question_item){
            $secondsolution_array[$question_item->id] = $question_item->text_1;
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function assortmentSentencesCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }

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
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $secondsolution_array[$question_item->id][] = $question_item->$option;
            }
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function assortmentWordsCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
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
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            for($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $secondsolution_array[$question_item->id][] = $question_item->$option;
            }
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function assortmentImagesCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            foreach($answer_array as $key => $question_item_response_id){
                $question_item->options_answered = $question_item_response_id;
            }
            $question_item->save();
        }

        // Solution
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
                $secondsolution_array[] = $question_item->id;
        }
        // dd($answer_array, $secondsolution_array, $question_item);

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }

    public function vowelsCorrection($question, $answer_array)
    {
        // Missing answers = WRONG = 0
        if (array_search(null, $answer_array) !== false){
            // dd('WRONG - SCORE 0', $answer_array);
            return 0;
        }
        // Save Answers given
        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $secondsearch_string = $question_item->id . ','.$i;
                foreach($answer_array as $label_key => $secondsub_array){
                    foreach($secondsub_array as $question_item_response_id){
                        if($secondsearch_string == $question_item_response_id){
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
        $secondsolution_array = [];
        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $unique_vowels[] = $question_item->$option;
            }
        }
        foreach(array_unique($unique_vowels) as $vowel){
            $secondsolution_array[$vowel] = [];
        }

        foreach ($question->question_items as $question_item) {
            for ($i = 0; $i < $question_item->options_number; $i++){
                $option = "options_".($i+1);
                $secondsolution_array[$question_item->$option][] = $question_item->id . ',' . $i;
            }
        }

        foreach($answer_array as $key => &$secondsub_array){
            sort($secondsub_array);
        }
        foreach($secondsolution_array as $key => &$secondsub_array){
            sort($secondsub_array);
        }

        if($answer_array == $secondsolution_array){
            return $question->avaliation_score;
        }
        else{
            return 0;
        }
    }
}
