<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;

class Exercise extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'exercise_category_id', 'exercise_level_id', 'introduction', 'duration', 'presentation_image', 'statement', 
        'audiovisual_desc', 'audio_transcript', 'has_time', 'time', 'has_interruption', 'interruption_time',
        'can_clone', 'only_my_students', 'only_after_correction'
    ];   

    /**
     * Validation Rules for user add
     *
     * @var array
     */
    public static $rulesForAdd = array(
        'title' => 'required',
    );

    public static function rulesForEdit($id = 0, $merge = [])
    {
        return array_merge([
            'title' => 'required',
        ], $merge);
    }

    /**
     * Validation Messages for user add
     *
     * @var array
     */
    public static $messages = array(
        'title.required' => 'O título do exercício é de preenchimento obrigatório.',
    );

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
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
     * Exercise Tags pivot
     */
    public function exercise_tags() {
        return $this->belongsToMany(
            'App\Tag', 
            'exercises_tags', 
            'exercise_id', 
            'tag_id'
        );
    }

    /**
     * Exercise Favorites pivot
     */
    public function exercise_favorite() {
        return $this->belongsToMany(
            'App\User', 
            'exercise_favourites', 
            'exercise_id', 
            'user_id'
        );
    }

    /**
     * Medias
     */
    public function medias()
    {
        return $this->hasOne('App\ExerciseMedia');
    }

    /**
     * Exercise is favorite
     */
    public function is_exercise_favorite()
    {
        if(ExerciseFavorite::where('exercise_id', $this->id)->where('user_id', auth()->user()->id)->first()){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Questions
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    
    /**
     * Exames
     */
    public function exames()
    {
        return $this->hasMany('App\Exame');
    }

    /**
     * Exercicse Evaluation Median
     */
    public function evaluationMedia()
    {
        $exames = $this->exames()->get();
        $exercise_evaluatin_median = 0;

        if(!$exames->count()){
            return 'no_exames_yet';
        }

        foreach ($exames as $exame) {

            $exame_evaluation_median = 0;

            if(!$exame->questions->count()){
                $exercise_evaluatin_median += 0;
                continue;
            }

            $exercise_sum_score_points = $exame->questions->sum('avaliation_score');
            $exercise_student_score = $exame->questions->sum('classification');

            $score_perc = $exercise_sum_score_points == 0 ? 0 : round(($exercise_student_score / $exercise_sum_score_points) * 100);
            
            $exercise_evaluatin_median += $score_perc;
        }

        $exercise_evaluatin_median = $exercise_evaluatin_median == 0 ? 0 : round($exercise_evaluatin_median / $exames->count());

        return $exercise_evaluatin_median;

    }

    /**
     * PROFESSOR
     */
    public function saveExercise($inputs)
    {
        $this->user_id = auth()->user()->id;
        $this->title = $inputs['title'];
        $this->exercise_category_id = $inputs['category'];
        $this->exercise_level_id = $inputs['level'];

        $this->introduction = isset($inputs['introduction']) ? $inputs['introduction'] : null;
        $this->duration = isset($inputs['duration']) ? $inputs['duration'] : null;
        $this->statement = isset($inputs['statement']) ? $inputs['statement'] : null;
        $this->audiovisual_desc = isset($inputs['audiovisual_desc']) ? $inputs['audiovisual_desc'] : null;
        $this->audio_transcript = isset($inputs['audio_transcript']) ? $inputs['audio_transcript'] : null;
        $this->has_time = isset($inputs['has_time']) ? 1 : 0;
        $this->time = isset($inputs['time']) ? $inputs['time'] : null;
        $this->has_interruption = isset($inputs['has_interruption']) ? 1 : 0;
        $this->interruption_time = isset($inputs['interruption_time']) ? $inputs['interruption_time'] : null;
        $this->can_clone = isset($inputs['can_clone']) ? 1 : 0;
        $this->only_my_students = isset($inputs['only_my_students']) ? 1 : 0;
        $this->only_after_correction = isset($inputs['only_after_correction']) ? 1 : 0;

        $this->save();

        if(isset($inputs['tags'])){
            ExerciseTag::where('exercise_id', $this->id)->delete();
            foreach ($inputs['tags'] as $tag) {
                ExerciseTag::create([
                    'exercise_id' => $this->id,
                    'tag_id' => $tag
                ]);
            }
            $this->save();
        }
        // dd($inputs);

        if(isset($inputs['external_media_files'])){
            self::updatePosterAndMedias($this->id, $inputs['external_media_files'], 'media', true);
        }
        else if(isset($inputs['media_files'])){
            self::updatePosterAndMedias($this->id, $inputs['media_files'], 'media');
        }
        else{
            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$this->id.'/medias');
            $this->medias()->delete();
        }
        if(isset($inputs['presentation_files'])){
            self::updatePosterAndMedias($this->id, $inputs['presentation_files'], 'presentation');
        }
        else{
            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$this->id.'/presentation_image');
            $this->presentation_image = null;
            $this->save();
        }

    }

    public function updatePosterAndMedias($exercise_id, $media, $media_or_presentation, $isExternal = false)
    {
        // dd(is_string($media), $media);
        if(is_string($media) && $media_or_presentation == 'media' && $isExternal){
            $this->medias()->delete();
            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$exercise_id.'/medias');

            $ex_media = ExerciseMedia::create([
                'exercise_id' => $exercise_id,
                'media_url' => strpos($media, 'https://') === 0 ? $media : "https://www.youtube.com/embed/" . $media,
                'media_type' => 'external_video'
            ]);

            // dd($ex_media);
        }
        if(!is_string($media) && $media_or_presentation == 'media' && !$isExternal){
            $this->medias()->delete();
            $upload_date = date('Y-m-d_H:i:s_');
            $paths = [];

            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$exercise_id.'/medias');

            $fileName = $upload_date . $media->getClientOriginalName();

            $paths = $media->storeAs('/exercises/'
                . $exercise_id . '/medias', $fileName, 'webapp-macau-storage');

            ExerciseMedia::create([
                'exercise_id' => $exercise_id,
                'media_url' => $fileName,
                'media_type' => $media->getMimeType()
            ]);
        }

        if(!is_string($media) && $media_or_presentation == 'presentation' && !$isExternal){
            $upload_date = date('Y-m-d_H:i:s_');
            $paths = [];

            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$exercise_id.'/presentation_image');

            $fileName = $upload_date . $media->getClientOriginalName();

            $paths = $media->storeAs('/exercises/'
                . $exercise_id . '/presentation_image', $fileName, 'webapp-macau-storage');

            $this->presentation_image = $fileName;
            $this->save();

        }
    }

    public static function applyFilters($filters = [])
    {
        // Order by date filter
        if($filters['exercise_order_by_date_asc'] == 'on'){
            $query = self::orderBy('created_at', 'asc');
        }
        else if($filters['exercise_order_by_date_desc'] == 'on'){
            $query = self::orderBy('created_at', 'desc');
        }
        else{
            $query = self::orderBy('created_at', 'desc');
        }

        $query = $query->where('published', 1);

        // My Favorites filter
        if(isset($filters['my_favorites'])){
            $query = $query->whereHas('exercise_favorite', function($q) {
                return $q->where('exercise_favourites.user_id', auth()->user()->id);
            });
        }

        // Levels filters
        if(!isset($filters['all_levels']) && isset($filters['levels']) && !empty($filters['levels'])){
            $query = $query->whereIn('exercise_level_id', $filters['levels']);
        }

        // Categories filters
        if(!isset($filters['all_categories']) && isset($filters['categories']) && !empty($filters['categories'])){
            $query = $query->whereIn('exercise_category_id', $filters['categories']);
        }

        // Tags filters
        if(isset($filters['tags']) && !empty($filters['tags'])){
            $query = $query->whereHas('exercise_tags', function($q) use ($filters) {
                return $q->whereIn('exercises_tags.tag_id', $filters['tags']);
            });
        }

        // Visibility filters
        if(!isset($filters['show_vis_all']) && isset($filters['show_vis_my_students'])){
            $query = $query->where('only_my_students', 1);
        }

        // Professor filters
        if(!isset($filters['show_all_professors']) && isset($filters['show_professors']) && !empty($filters['show_professors'])){
            $query = $query->whereIn('user_id', $filters['show_professors']);
        }

        $query = $query->orWhere(function ($query) use ($filters){
            $query->where('published', 0)
                ->where('user_id', auth()->user()->id);

            // My Favorites filter
            if(isset($filters['my_favorites'])){
                $query = $query->whereHas('exercise_favorite', function($q) {
                    return $q->where('exercise_favourites.user_id', auth()->user()->id);
                });
            }

            // Levels filters
            if(!isset($filters['all_levels']) && isset($filters['levels']) && !empty($filters['levels'])){
                $query = $query->whereIn('exercise_level_id', $filters['levels']);
            }

            // Categories filters
            if(!isset($filters['all_categories']) && isset($filters['categories']) && !empty($filters['categories'])){
                $query = $query->whereIn('exercise_category_id', $filters['categories']);
            }

            // Tags filters
            if(isset($filters['tags']) && !empty($filters['tags'])){
                $query = $query->whereHas('exercise_tags', function($q) use ($filters) {
                    return $q->whereIn('exercises_tags.tag_id', $filters['tags']);
                });
            }

            // Visibility filters
            if(!isset($filters['show_vis_all']) && isset($filters['show_vis_my_students'])){
                $query = $query->where('only_my_students', 1);
            }

            // Professor filters
            if(!isset($filters['show_all_professors']) && isset($filters['show_professors']) && !empty($filters['show_professors'])){
                $query = $query->whereIn('user_id', $filters['show_professors']);
            }
        });

        $skip = $filters['page'] * 4;

        return $query->skip($skip)->paginate(4);
    }

    public static function applyExerciseValidationFilters($filters)
    {
        // dd($filters);
        $query = self::orderBy('created_at', 'desc');

        // Name Filter
        if(isset($filters['settings_exercises_filter_name']) && $filters['settings_exercises_filter_name']){
            $query = $query->where('title', 'LIKE', '%' . $filters['settings_exercises_filter_name'] . '%');
        }

        if(isset($filters['settings_exercises_filter_category']) && $filters['settings_exercises_filter_category'] != 'all'){
            $query = $query->where('exercise_category_id', $filters['settings_exercises_filter_category']);
        }

        if(isset($filters['settings_exercises_filter_level']) && $filters['settings_exercises_filter_level'] != 'all'){
            $query = $query->where('exercise_level_id', $filters['settings_exercises_filter_level']);
        }

        if(isset($filters['settings_exercises_filter_published']) && $filters['settings_exercises_filter_published'] != 'all'){
            $query = $query->where('published', $filters['settings_exercises_filter_published']);
        }

        $skip = $filters['page'] * 10;

        return $query->skip($skip)->paginate(10)->setPageName('exercises');
    }

    public static function deleteExercise($id)
    {
        $exercise = self::find($id);

        // delete exercises
        foreach(ExerciseFavorite::where('exercise_id', $exercise->id)->get() as $exerciseFavorite)
        {
            $exerciseFavorite->delete();
        }

        foreach ($exercise->questions as $question) {
            foreach ($question->question_items as $question_item) {
                if($question_item->question_item_media){
                    $question_item->question_item_media->delete();
                }
                $question_item->delete();
            }
            $question->delete();
        }

        foreach ($exercise->exames as $exame) 
        {
            foreach ($exame->questions as $question) {
                foreach ($question->question_items as $question_item) {
                    if($question_item->question_item_media){
                        $question_item->question_item_media->delete();
                    }
                    $question_item->delete();
                }
                $question->delete();
            }
            $exame->medias()->delete();
            $exame->inquiries()->delete();
            $exameStudentId = $exame->student->id;
            $exameId = $exame->id;
            $exame->delete();
            Storage::disk('webapp-macau-storage')->deleteDirectory('student_exames/'.$exameStudentId.'/exame/' . $exameId);
        }

        foreach ($exercise->exercise_tags as $exerciseTag)
        {
            $exerciseTag->delete();
        }

        $exercise->medias()->delete();
        $exerciseId = $exercise->id;
        $exercise->delete();
        Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/' . $exerciseId);
    }
}
