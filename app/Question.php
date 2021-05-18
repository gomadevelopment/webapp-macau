<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\UploadedFile;

use Illuminate\Validation\Rule;

class Question extends Model
{
    protected $fillable = [
        'exercise_id', 'title', 'section', 'question_type_id', 'question_subtype_id', 
        'reference', 'description', 'description_image_url', 'teacher_correction', 'avaliation_score'
    ];

    // public static $rulesForAdd = array(
    //     // 'question_name' => 'required',
    //     // 'question_reference' => 'required',
    //     'question_description' => 'required',
    //     'question_type' => 'required',
    //     'question_reference' => 'unique:questions',
    // );

    public static function rulesForAdd($id = 0, $merge = [])
    {
        return array_merge([
            'question_description' => 'required',
            'question_type' => 'required',
            // 'question_reference' => 'unique:questions',
        ], $merge);
    }

    public static function rulesForEdit($id = 0, $merge = [])
    {
        return array_merge([
            // 'question_name' => 'required',
            // 'question_reference' => 'required',
            'question_description' => 'required',
            'question_type' => 'required',
            // 'question_reference' => [Rule::unique('questions', 'reference')->ignore($id)],
        ], $merge);
    }

    public static $messages = array(
        // 'question_name.required' => 'O título da questão é de preenchimento obrigatório.',
        // 'question_reference.required' => 'A referência da questão é de preenchimento obrigatório.',
        'question_description.required' => 'A descrição da questão a apresentar ao aluno é de preenchimento obrigatório.',
        'question_type.required' => 'Escolha um tipo de questão e preencha os seus campos.',
        'question_reference.unique' => 'Já existe uma questão com esta referência.',
    );

    /**
     * Exercise
     */
    public function exercise()
    {
        return $this->belongsTo('App\Exercise', 'exercise_id');
    }

    /**
     * Question Items
     */
    public function question_items()
    {
        return $this->hasMany('App\QuestionItem');
    }

    /**
     * Question Type
     */
    public function question_type()
    {
        return $this->belongsTo('App\QuestionType', 'question_type_id');
    }

    /**
     * Question SubType
     */
    public function question_subtype()
    {
        return $this->belongsTo('App\QuestionSubType', 'question_subtype_id');
    }

    /**
     * Get Models by Question Reference
     */
    public static function my_models()
    {
        $query = self::orderBy('created_at', 'asc')->where('reference', '!=', null);

        $query = $query->whereHas('exercise', function($q) {
            return $q->where('exercises.user_id', auth()->user()->id);
        });

        return $query->get()->unique('reference');
    }

    /**
     * Get Models by Question Reference
     */
    public static function myModelsWithFilters($filters = [])
    {
        $query = self::orderBy('created_at', 'asc')->where('reference', '!=', null);
        // dd($filters);
        $query = $query->whereHas('exercise', function($q) {
            return $q->where('exercises.user_id', auth()->user()->id);
        });

        if(isset($filters['questions_filter_reference'])){
            $query = $query->where('reference', 'LIKE', '%' . $filters['questions_filter_reference'] . '%');
        }

        if(isset($filters['questions_filter_exercises']) && $filters['questions_filter_exercises'] != 'all'){
            $query = $query->whereHas('exercise', function($q) use ($filters) {
                return $q->where('exercises.id', $filters['questions_filter_exercises']);
            });
        }

        $skip = $filters['page'] * 10;

        return $query->skip($skip)->distinct('reference')->paginate(10)->setPageName('questions');
    }

    /**
     * Get Models by Question Reference
     */
    public static function exercisesWithQuestionsWithReference()
    {
        $questions = self::my_models();
        $exercises = [];

        foreach ($questions as $question) {
            $exercises[] = $question->exercise;
        }

        // dd(collect($exercises)->unique()->count());

        return collect($exercises)->unique();
    }

    public function switchQuestionType($exercise, $inputs)
    {
        // dd($inputs);
        if($inputs['question_subtype'] == 'same_type_and_subtype'){
            switch ($inputs['question_type']) {
                case 1:
                    $inputs['question_subtype'] = 1;
                    break;
                case 4:
                    $inputs['question_subtype'] = 7;
                    break;
                case 6:
                    $inputs['question_subtype'] = 10;
                    break;
                // case 7:
                //     $inputs['question_subtype'] = 11;
                //     break;
                case 8:
                    $inputs['question_subtype'] = 12;
                    break;
                case 9:
                    $inputs['question_subtype'] = 13;
                    break;
                case 11:
                    $inputs['question_subtype'] = 17;
                    break;
                default:
                    break;
            }
        }

        $bool_same_type_and_subtype = false;
        if($this->question_type_id == $inputs['question_type'] && $this->question_subtype_id == $inputs['question_subtype']){
            $bool_same_type_and_subtype = true;
        }

        $this->exercise_id = $exercise->id;
        $this->title = null;
        $this->section = $inputs['exercise_question_section'];
        $this->question_type_id = $inputs['question_type'];
        $this->question_subtype_id = $inputs['question_subtype'];
        $this->reference = $inputs['question_reference'];
        $this->description = $inputs['question_description'];
        $this->teacher_correction = isset($inputs['correction_required']) ? 1 : 0;
        $this->avaliation_score = $inputs['question_score'];

        $this->save();

        if(isset($inputs['description_image_input'])){
            if(strpos($inputs['description_image_input'], 'from_storage_') !== false){
                if(isset($inputs['question_model_id'])){
                    $question_model = self::find($inputs['question_model_id']);
                    $copy_from = 'questions/' . $question_model->id . '/description_image/' . $question_model->description_image_url;
                    $copy_to = 'questions/' . $this->id . '/description_image/' . $question_model->description_image_url;
                    Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                    $this->description_image_url = $question_model->description_image_url;
                }
            }
            else{
                $file = $inputs['description_image_input'];
                $paths = [];

                $fileName = $file->getClientOriginalName();

                Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/description_image');

                $paths = $file->storeAs('/questions/'
                    . $this->id . '/description_image', $fileName, 'webapp-macau-storage');

                $this->description_image_url = $file->getClientOriginalName();
            }
        }
        else{
            Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/description_image');
            $this->description_image_url = null;
        }

        $this->save();

        switch ($inputs['question_type']) {
            case 1:
                $this->informationQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 2:
                $this->correspondenceQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 3:
                $this->fillQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 4:
                $this->trueOrFalseQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 5:
                $this->multipleChoiceQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 6:
                $this->freeQuestionQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 7:
                $this->differencesQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 8:
                $this->statementCorrectionQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 9:
                $this->automaticContentQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 10:
                $this->assortmentQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            case 11:
                $this->vowelsQuestionType($inputs, $bool_same_type_and_subtype);
                break;
            default:
                break;
        }
    }

    public function informationQuestionType($inputs, $bool_same_type_and_subtype)
    {
        foreach($this->question_items as $question_item){
            $question_item->delete();
        }

        QuestionItem::create([
            'question_id' => $this->id,
            'text_1' => $inputs['info_text']
        ]);
    }

    public function correspondenceQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        if($this->question_subtype_id == 2){
            
            foreach($input_indexes as $index){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['corr_image_description_'.$index];
                $question_item->save();
                
                if(isset($inputs['corr_image_file_input_'.$index])){
                    if(strpos($inputs['corr_image_file_input_'.$index], 'from_storage_') !== false){

                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['corr_image_file_input_'.$index])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }

                        continue;
                    }

                    $file = $inputs['corr_image_file_input_'.$index];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }

        }

        else if($this->question_subtype_id == 3){
            
            foreach($input_indexes as $index){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['corr_audio_description_'.$index];
                $question_item->save();

                if(isset($inputs['corr_audio_file_input_'.$index])){
                    // File from storage
                    if(strpos($inputs['corr_audio_file_input_'.$index], 'from_storage_') !== false){

                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['corr_audio_file_input_'.$index])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    // New File
                    else{
                        $file = $inputs['corr_audio_file_input_'.$index];
                        $upload_date = date('Y-m-d_H:i:s_');
                        $paths = [];

                        $fileName = $file->getClientOriginalName();

                        $paths = $file->storeAs('/questions/'
                            . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                        $question_item_media = QuestionItemMedia::create([
                            'question_item_id' => $question_item->id,
                            'media_url' => $file->getClientOriginalName(),
                            'media_type' => $file->getMimeType()
                        ]);
                    }
                }
            }
        }

        else if($this->question_subtype_id == 4){

            foreach($this->question_items as $question_item){
                // $question_item->question_item_media->delete();
                $question_item->delete();
            }
            
            foreach($input_indexes as $question_key => $answers_array){

                $question_item = QuestionItem::create([
                    'question_id' => $this->id,
                    'text_1' => $inputs['corr_category_question_'.$question_key]
                ]);
                $options_count = 1;
                foreach($answers_array as $answer_index){
                    $option = "options_".$options_count;
                    $question_item->$option = $inputs['corr_category_answer_'.$answer_index.'_question_'.$question_key];
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }
            }

        }
    }

    public function fillQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        if($this->question_subtype_id == 5){

            foreach ($input_indexes as $index) {

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['fill_textarea_'.$index];
                $question_item->save();

                if(isset($inputs['fill_associate_media_file_input_'.$index])){
                    if(strpos($inputs['fill_associate_media_file_input_'.$index], 'from_storage_') !== false){
                        
                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['fill_associate_media_file_input_'.$index])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    $file = $inputs['fill_associate_media_file_input_'.$index];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }
        }

        else if($this->question_subtype_id == 6){

            foreach($this->question_items as $question_item){
                // $question_item->question_item_media->delete();
                $question_item->delete();
            }

            foreach ($input_indexes as $word_key => $selects_array) {
                $question_item = QuestionItem::create([
                    'question_id' => $this->id,
                    'text_1' => $inputs['fill_text_word_'.$word_key]
                ]);
                $options_count = 1;
                foreach($selects_array as $select_index){
                    $option = "options_".$options_count;
                    $select_options = $inputs['select_text_word_'.$word_key.'_option_'.$select_index];
                    $question_item->$option = '';
                    foreach ($select_options as $select_option_key => $select_option_value) {
                        if ($select_option_key === array_key_last($select_options)){
                            $question_item->$option .= $select_option_value;
                        }
                        else{
                            $question_item->$option .= $select_option_value . '|';
                        }
                        
                    }
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }
            }
        }

        if($this->question_subtype_id == 18){
            // dd($input_indexes);
            foreach ($input_indexes as $index) {

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['fill_options_writing_textarea_'.$index];
                $question_item->save();

                if(isset($inputs['fill_options_writing_associate_media_file_input_'.$index])){
                    if(strpos($inputs['fill_options_writing_associate_media_file_input_'.$index], 'from_storage_') !== false){
                        
                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['fill_options_writing_associate_media_file_input_'.$index])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    $file = $inputs['fill_options_writing_associate_media_file_input_'.$index];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }
        }
    }

    public function trueOrFalseQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        foreach($input_indexes as $index){

            if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                $question_item = new QuestionItem();
            }

            else{
                $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
            }

            $question_item->question_id = $this->id;
            $question_item->text_1 = $inputs['true_or_false_input_'.$index];
            $question_item->options_correct = $inputs['true_or_false_select_'.$index];
            $question_item->save();

            if(isset($inputs['true_or_false_associate_media_file_input_'.$index])){
                // File from storage
                if(strpos($inputs['true_or_false_associate_media_file_input_'.$index], 'from_storage_') !== false){

                    if(isset($inputs['question_model_id'])){
                        $question_model = self::find($inputs['question_model_id']);
                        $question_model_item = QuestionItem::find(explode('_', $inputs['true_or_false_associate_media_file_input_'.$index])[2]);
                        $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                        $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                        Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                        $question_item_media = QuestionItemMedia::create([
                            'question_item_id' => $question_item->id,
                            'media_url' => $question_model_item->question_item_media->media_url,
                            'media_type' => $question_model_item->question_item_media->media_type
                        ]);
                    }
                    
                    continue;
                }
                // New File
                else{
                    $file = $inputs['true_or_false_associate_media_file_input_'.$index];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }
        }
    }

    public function multipleChoiceQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        if($this->question_subtype_id == 8){
            
            foreach($input_indexes as $question_key => $answers_array){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$question_key])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$question_key]);
                    
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['multiple_choice_question_'.$question_key];
                $question_item->options_correct = null;
                $question_item->save();

                $options_count = 1;
                foreach($answers_array as $answer_index){
                    $option = "options_".$options_count;
                    $question_item->$option = $inputs['multiple_choice_answer_'.$answer_index.'_question_'.$question_key];
                    if(isset($inputs['multiple_choice_correct_answer_'.$answer_index.'_question_'.$question_key])){
                        if($question_item->options_correct == null){
                            $question_item->options_correct = $options_count;
                        }
                        else{
                            $question_item->options_correct .= ', ' . $options_count;
                        }
                    }
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }

                if(isset($inputs['m_c_associate_media_file_input_'.$question_key])){
                    if(strpos($inputs['m_c_associate_media_file_input_'.$question_key], 'from_storage_') !== false){
                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['m_c_associate_media_file_input_'.$question_key])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    $file = $inputs['m_c_associate_media_file_input_'.$question_key];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }
        }

        if($this->question_subtype_id == 9){

            foreach($this->question_items as $question_item){
                $question_item->delete();
            }

            foreach($input_indexes as $question_key => $answers_array){

                $question_item = QuestionItem::create([
                    'question_id' => $this->id
                ]);
                $options_count = 1;
                foreach($answers_array as $answer_index){
                    $option = "options_".$options_count;
                    $question_item->$option = $inputs['multiple_choice_intruder_input_answer_'.$answer_index.'_question_'.$question_key];
                    if(isset($inputs['multiple_choice_intruder_intruder_answer_'.$answer_index.'_question_'.$question_key])){
                        if($question_item->options_correct == null){
                            $question_item->options_correct = $options_count;
                        }
                        else{
                            $question_item->options_correct .= ', ' . $options_count;
                        }
                    }
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }
            }

        }
    }

    public function freeQuestionQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        foreach($input_indexes as $index){

            if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                $question_item = new QuestionItem();
            }

            else{
                $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
            }

            $question_item->question_id = $this->id;
            $question_item->text_1 = $inputs['free_question_'.$index];
            $question_item->save();

            if(isset($inputs['f_q_associate_media_file_input_'.$index])){
                if(strpos($inputs['f_q_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    if(isset($inputs['question_model_id'])){
                        $question_model = self::find($inputs['question_model_id']);
                        $question_model_item = QuestionItem::find(explode('_', $inputs['f_q_associate_media_file_input_'.$index])[2]);
                        $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                        $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                        Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                        $question_item_media = QuestionItemMedia::create([
                            'question_item_id' => $question_item->id,
                            'media_url' => $question_model_item->question_item_media->media_url,
                            'media_type' => $question_model_item->question_item_media->media_type
                        ]);
                    }
                    
                    continue;
                }
                $file = $inputs['f_q_associate_media_file_input_'.$index];
                $upload_date = date('Y-m-d_H:i:s_');
                $paths = [];

                $fileName = $file->getClientOriginalName();

                $paths = $file->storeAs('/questions/'
                    . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                $question_item_media = QuestionItemMedia::create([
                    'question_item_id' => $question_item->id,
                    'media_url' => $file->getClientOriginalName(),
                    'media_type' => $file->getMimeType()
                ]);
            }
        }
    }

    public function differencesQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        // dd($inputs, $input_indexes, $this);

        if($this->question_subtype_id == 11){
            foreach($this->question_items as $question_item){
                $question_item->delete();
            }
            
            foreach($input_indexes as $index){
                QuestionItem::create([
                    'question_id' => $this->id,
                    'text_1' => $inputs['differences_text_'.$index],
                    'text_2' => $inputs['differences_solution_'.$index]
                ]);
            }
        }

        if($this->question_subtype_id == 19){
            // foreach($this->question_items as $question_item){
            //     $question_item->delete();
            // }
            foreach($input_indexes as $index){
                $options_correct_words = '';
                $regex = "/<%\s*([\s*A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_]*[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9_])\s*%>/";
                preg_match_all($regex, $inputs['differences_find_words_textarea_'.$index], $matches);
                $numItems = count($matches[1]);
                $i = 0;
                foreach($matches[1] as $key => $word_match){
                    if(++$i === $numItems) {
                        $options_correct_words .= $word_match;
                    }
                    else{
                        $options_correct_words .= $word_match . ', ';
                    }
                }

                $t1 = str_replace('<% ', '', $inputs['differences_find_words_textarea_'.$index]);
                $t2 = str_replace('<%', '', $t1);
                $t3 = str_replace(' %>', '', $t2);
                $text_without_delimiters = str_replace('%>', '', $t3);

                QuestionItem::create([
                    'question_id' => $this->id,
                    'text_1' => $inputs['differences_find_words_textarea_'.$index],
                    'text_2' => $text_without_delimiters,
                    'options_correct' => $options_correct_words
                ]);
            }
            
        }

        // dd('STOP');
    }

    public function statementCorrectionQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        foreach($this->question_items as $question_item){
            $question_item->delete();
        }
        
        foreach($input_indexes as $index){
            QuestionItem::create([
                'question_id' => $this->id,
                'text_1' => $inputs['correction_of_statement_question_'.$index],
                'text_2' => $inputs['correction_of_statement_solution_'.$index]
            ]);
        }
    }

    public function automaticContentQuestionType($inputs, $bool_same_type_and_subtype)
    {
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        foreach($this->question_items as $question_item){
            $question_item->delete();
        }
        
        foreach($input_indexes as $index){
            QuestionItem::create([
                'question_id' => $this->id,
                'text_1' => $inputs['split_textarea_'.$index]
            ]);
        }
    }

    public function assortmentQuestionType($inputs, $bool_same_type_and_subtype)
    {
        // dd($inputs);
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        if($this->question_subtype_id == 14){

            foreach($this->question_items as $question_item){
                $question_item->delete();
            }

            foreach($input_indexes as $question_key => $sentences_array){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$question_key])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$question_key]);
                    
                }

                $question_item->question_id = $this->id;
                $question_item->save();

                $options_count = 1;
                foreach($sentences_array as $sentence_index){
                    $option = "options_".$options_count;
                    $question_item->$option = $inputs['assort_sentences_sentence_'.$sentence_index.'_question_'.$question_key];
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }

            }

        }

        else if($this->question_subtype_id == 15){

            // foreach($this->question_items as $question_item){
            //     $question_item->delete();
            // }

            foreach($input_indexes as $question_key => $words_array){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$question_key])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$question_key]);
                    
                }

                $question_item->question_id = $this->id;
                $question_item->save();

                $options_count = 1;
                foreach($words_array as $word_index){
                    $option = "options_".$options_count;
                    $question_item->$option = $inputs['assort_words_solution_'.$word_index.'_question_'.$question_key];
                    $question_item->options_number = $options_count;
                    $question_item->save();
                    $options_count++;
                }

                if(isset($inputs['assort_words_media_file_input_'.$question_key])){
                    if(strpos($inputs['assort_words_media_file_input_'.$question_key], 'from_storage_') !== false){
                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['assort_words_media_file_input_'.$question_key])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    $file = $inputs['assort_words_media_file_input_'.$question_key];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }

            }

        }

        else if($this->question_subtype_id == 16){

            foreach($input_indexes as $index){

                if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$index])){
                    $question_item = new QuestionItem();
                }

                else{
                    $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$index]);
                }

                $question_item->question_id = $this->id;
                $question_item->text_1 = $inputs['assort_image_input_'.$index];
                $question_item->save();

                if(isset($inputs['assort_image_media_file_input_'.$index])){
                    if(strpos($inputs['assort_image_media_file_input_'.$index], 'from_storage_') !== false){
                        if(isset($inputs['question_model_id'])){
                            $question_model = self::find($inputs['question_model_id']);
                            $question_model_item = QuestionItem::find(explode('_', $inputs['assort_image_media_file_input_'.$index])[2]);
                            $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                            $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                            Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                            $question_item_media = QuestionItemMedia::create([
                                'question_item_id' => $question_item->id,
                                'media_url' => $question_model_item->question_item_media->media_url,
                                'media_type' => $question_model_item->question_item_media->media_type
                            ]);
                        }
                        
                        continue;
                    }
                    $file = $inputs['assort_image_media_file_input_'.$index];
                    $upload_date = date('Y-m-d_H:i:s_');
                    $paths = [];

                    $fileName = $file->getClientOriginalName();

                    $paths = $file->storeAs('/questions/'
                        . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                    $question_item_media = QuestionItemMedia::create([
                        'question_item_id' => $question_item->id,
                        'media_url' => $file->getClientOriginalName(),
                        'media_type' => $file->getMimeType()
                    ]);
                }
            }
        }
    }

    public function vowelsQuestionType($inputs, $bool_same_type_and_subtype)
    {
        // dd($inputs);
        $input_indexes = self::inputIndexes($inputs, $this->question_subtype_id, $bool_same_type_and_subtype);

        // dd($inputs, $input_indexes);

        // foreach($this->question_items as $question_item){
        //     $question_item->delete();
        // }

        foreach($input_indexes as $word_key => $vowels_array){

            if(!$bool_same_type_and_subtype || !isset($inputs['existent_question_item_id_'.$word_key])){
                $question_item = new QuestionItem();
            }

            else{
                $question_item = QuestionItem::find($inputs['existent_question_item_id_'.$word_key]);
                
            }

            $question_item->question_id = $this->id;
            $question_item->text_1 = $inputs['vowels_word_'.$word_key];
            $question_item->text_2 = '';
            foreach($inputs['possible_vowels'] as $possible_vowel_index => $possible_vowel_value){
                if($possible_vowel_index === array_key_last($inputs['possible_vowels'])){
                    $question_item->text_2 .= $possible_vowel_value;
                }
                else{
                    $question_item->text_2 .= $possible_vowel_value . '|';
                }
            }
            // dd($inputs['possible_vowels'], $question_item->text_2);
            $question_item->save();

            $options_count = 1;
            foreach($vowels_array as $vowel_index){
                $option = "options_".$options_count;
                $question_item->$option = $inputs['select_word_'.$word_key.'_vowel_'.$vowel_index];
                $question_item->options_number = $options_count;
                $question_item->save();
                $options_count++;
            }

            if(isset($inputs['vowels_media_file_input_'.$word_key])){
                if(strpos($inputs['vowels_media_file_input_'.$word_key], 'from_storage_') !== false){
                    if(isset($inputs['question_model_id'])){
                        $question_model = self::find($inputs['question_model_id']);
                        $question_model_item = QuestionItem::find(explode('_', $inputs['vowels_media_file_input_'.$word_key])[2]);
                        $copy_from = 'questions/' . $question_model->id . '/question_item/' . $question_model_item->id . '/' . $question_model_item->question_item_media->media_url;
                        $copy_to = 'questions/' . $this->id . '/question_item/' . $question_item->id . '/' . $question_model_item->question_item_media->media_url;
                        Storage::disk('webapp-macau-storage')->copy($copy_from, $copy_to);
                        $question_item_media = QuestionItemMedia::create([
                            'question_item_id' => $question_item->id,
                            'media_url' => $question_model_item->question_item_media->media_url,
                            'media_type' => $question_model_item->question_item_media->media_type
                        ]);
                    }
                    
                    continue;
                }
                $file = $inputs['vowels_media_file_input_'.$word_key];
                $upload_date = date('Y-m-d_H:i:s_');
                $paths = [];

                $fileName = $file->getClientOriginalName();

                $paths = $file->storeAs('/questions/'
                    . $this->id . '/question_item/' . $question_item->id, $fileName, 'webapp-macau-storage');

                $question_item_media = QuestionItemMedia::create([
                    'question_item_id' => $question_item->id,
                    'media_url' => $file->getClientOriginalName(),
                    'media_type' => $file->getMimeType()
                ]);
            }

        }

    }

    public function inputIndexes($inputs, $question_subtype, $bool_same_type_and_subtype)
    {
        $input_indexes = [];

        // CORRESPONDENCE //

        // Images
        if($question_subtype == 2){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'corr_image_description_') === 0) {
                    $input_indexes[] = explode('_', $key)[3];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['corr_image_file_input_'.$index]) && strpos($inputs['corr_image_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['corr_image_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }
        // Audio / Video
        else if($question_subtype == 3){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'corr_audio_description_') === 0) {
                    $input_indexes[] = explode('_', $key)[3];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['corr_audio_file_input_'.$index]) && strpos($inputs['corr_audio_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['corr_audio_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }
        // Categories
        else if($question_subtype == 4){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'corr_category_question_') === 0) {
                    $question_id = explode('_', $key)[3];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'corr_category_answer_') === 0){
                            $question_id2 = explode('_', $key2)[5];
                            if($question_id == $question_id2){
                                $answer_id = explode('_', $key2)[3];
                                $input_indexes[$question_id][] = (int)$answer_id;
                            }
                            
                        }
                    }
                }
            }
        }

        // FILL OPTIONS

        // Shuffle
        else if($question_subtype == 5){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'fill_textarea_') === 0) {
                    $input_indexes[] = explode('_', $key)[2];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['fill_associate_media_file_input_'.$index]) && strpos($inputs['fill_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['fill_associate_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
            // dd($bool_same_type_and_subtype, $input_indexes, $existent_file_question_item_ids, $existent_question_item_ids);

        }
        // Text Words
        else if($question_subtype == 6){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'fill_text_word_') === 0) {
                    $word_id = explode('_', $key)[3];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'select_text_word_'.$word_id.'_option_') === 0){
                            $option_id = explode('_', $key2)[5];
                            $input_indexes[$word_id][] = (int)$option_id;
                            
                        }
                    }
                }
            }
        }
        // Writing
        else if($question_subtype == 18){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'fill_options_writing_textarea_') === 0) {
                    $input_indexes[] = explode('_', $key)[4];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['fill_options_writing_associate_media_file_input_'.$index]) && strpos($inputs['fill_options_writing_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['fill_options_writing_associate_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
            // dd($bool_same_type_and_subtype, $input_indexes, $existent_file_question_item_ids, $existent_question_item_ids);

        }

        // TRUE OR FALSE
        else if($question_subtype == 7){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'true_or_false_input_') === 0) {
                    $input_indexes[] = explode('_', $key)[4];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['true_or_false_associate_media_file_input_'.$index]) && strpos($inputs['true_or_false_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['true_or_false_associate_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }

        // MULTIPLE CHOICE

        // Questions
        else if($question_subtype == 8){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'multiple_choice_question_') === 0) {
                    $question_id = explode('_', $key)[3];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'multiple_choice_answer_') === 0){
                            $question_id2 = explode('_', $key2)[5];
                            if($question_id == $question_id2){
                                $answer_id = explode('_', $key2)[3];
                                $input_indexes[$question_id][] = (int)$answer_id;
                            }
                            
                        }
                    }
                }
            }
            // dd($input_indexes, $inputs);
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index => $array){
                if(isset($inputs['m_c_associate_media_file_input_'.$index]) && strpos($inputs['m_c_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['m_c_associate_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }
        // Intruder
        else if($question_subtype == 9){
            // dd($inputs);
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'multiple_choice_intruder_input_answer_') === 0) {
                    $question_id = explode('_', $key)[7];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'multiple_choice_intruder_input_answer_') === 0){
                            $question_id2 = explode('_', $key2)[7];
                            if($question_id == $question_id2){
                                $answer_id = explode('_', $key2)[5];
                                if(isset($input_indexes[$question_id]) && in_array((int)$answer_id, $input_indexes[$question_id])){
                                    continue;
                                }
                                else{
                                    $input_indexes[$question_id][] = (int)$answer_id;
                                }
                            }
                        }
                    }
                }
            }
        }

        // FREE QUESTION
        else if($question_subtype == 10){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'free_question_') === 0) {
                    $input_indexes[] = explode('_', $key)[2];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['f_q_associate_media_file_input_'.$index]) && strpos($inputs['f_q_associate_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['f_q_associate_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }

        // DIFFERENCES

        // Differences
        else if($question_subtype == 11){
            // differences_text_0
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'differences_text_') === 0) {
                    $input_indexes[] = explode('_', $key)[2];
                }
            }
        }
        // Find Words
        else if($question_subtype == 19){
            // differences_text_0
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'differences_find_words_textarea_') === 0) {
                    $input_indexes[] = explode('_', $key)[4];
                }
            }
        }

        // CORRECTION OF STATEMENTS
        else if($question_subtype == 12){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'correction_of_statement_question_') === 0) {
                    $input_indexes[] = explode('_', $key)[4];
                }
            }
        }

        // AUTOMATIC CONTENT
        else if($question_subtype == 13){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'split_textarea_') === 0) {
                    $input_indexes[] = explode('_', $key)[2];
                }
            }
        }

        // ASSORTMENT

        // Sentences
        else if($question_subtype == 14){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'assort_sentences_question_') === 0) {
                    $question_id = explode('_', $key)[3];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'assort_sentences_sentence_') === 0){
                            $question_id2 = explode('_', $key2)[5];
                            if($question_id == $question_id2){
                                $sentence_id = explode('_', $key2)[3];
                                if(isset($input_indexes[$question_id]) && in_array((int)$sentence_id, $input_indexes[$question_id])){
                                    continue;
                                }
                                else{
                                    $input_indexes[$question_id][] = (int)$sentence_id;
                                }
                            }
                        }
                    }
                }
            }
            // dd($input_indexes);
        }
        // Words
        else if($question_subtype == 15){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'assort_words_question_') === 0) {
                    $question_id = explode('_', $key)[3];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'assort_words_solution_') === 0){
                            $question_id2 = explode('_', $key2)[5];
                            if($question_id == $question_id2){
                                $word_id = explode('_', $key2)[3];
                                if(isset($input_indexes[$question_id]) && in_array((int)$word_id, $input_indexes[$question_id])){
                                    continue;
                                }
                                else{
                                    $input_indexes[$question_id][] = (int)$word_id;
                                }
                            }
                        }
                    }
                }
            }
            // dd($input_indexes, $inputs);
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index => $array){
                if(isset($inputs['assort_words_media_file_input_'.$index]) && strpos($inputs['assort_words_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['assort_words_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }
        // Images
        else if($question_subtype == 16){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'assort_image_input_') === 0) {
                    $input_indexes[] = explode('_', $key)[3];
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index){
                if(isset($inputs['assort_image_media_file_input_'.$index]) && strpos($inputs['assort_image_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['assort_image_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }

        // VOWELS
        else if($question_subtype == 17){
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'vowels_word_') === 0) {
                    $word_id = explode('_', $key)[2];
                    foreach ($inputs as $key2 => $value2) {
                        if (strpos($key2, 'select_word_'.$word_id.'_vowel_') === 0){
                            $vowel_id = explode('_', $key2)[4];
                            $input_indexes[$word_id][] = (int)$vowel_id;
                            
                        }
                    }
                }
            }
            $existent_file_question_item_ids = [];
            $existent_question_item_ids = [];
            foreach($input_indexes as $index => $array){
                if(isset($inputs['vowels_media_file_input_'.$index]) && strpos($inputs['vowels_media_file_input_'.$index], 'from_storage_') !== false){
                    $existent_file_question_item_ids[] = explode('_', $inputs['vowels_media_file_input_'.$index])[2];
                }
                if(isset($inputs['existent_question_item_id_'.$index])){
                    $existent_question_item_ids[] = $inputs['existent_question_item_id_'.$index];
                }
            }
        }

        // Delete files by existent question_items or not
        if(!$bool_same_type_and_subtype || empty($input_indexes)){

            foreach($this->question_items as $question_item){
                if($question_item->question_item_media){
                    $question_item->question_item_media->delete();
                    // Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/question_item/'.$question_item->id);
                }
                $question_item->delete();
                Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/question_item');
            }
        }
        else{
            foreach($this->question_items as $question_item){
                if(isset($existent_file_question_item_ids) 
                        && !in_array($question_item->id, $existent_file_question_item_ids)
                        && $question_item->question_item_media){
                    $question_item->question_item_media->delete();
                    Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/question_item/'.$question_item->id);
                }
                if(isset($existent_question_item_ids) 
                        && !in_array($question_item->id, $existent_question_item_ids)
                        && $question_item->question_item_media){
                    $question_item->question_item_media->delete();
                    Storage::disk('webapp-macau-storage')->deleteDirectory('questions/'.$this->id.'/question_item/'.$question_item->id);
                    $question_item->delete();
                }
            }
        }

        return $input_indexes;
    }
}
