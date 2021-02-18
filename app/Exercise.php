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
        'user_id', 'title', 'exercise_category_id', 'exercise_level_id', 'introduction', 'statement', 
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
     * PROFESSOR
     */
    public function saveExercise($inputs)
    {
        $this->user_id = auth()->user()->id;
        $this->title = $inputs['title'];
        $this->exercise_category_id = $inputs['category'];
        $this->exercise_level_id = $inputs['level'];

        $this->introduction = isset($inputs['introduction']) ? $inputs['introduction'] : null;
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

        if(isset($inputs['media_files'])){
            self::updatePosterAndMedias($this->id, $inputs['media_files']);
        }
        else{
            Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$this->id.'/medias');
            self::find($this->id)->medias()->delete();
        }

        Notification::create([
            'title' => 'Novo Exercício',
            'text' => 'Você criou um novo exercício, "'.$this->title.'".',
            'url' => '/exercicios/editar/' . $this->id,
            'param1_text' => 'exercise_id',
            'param1' => $this->id,
            'param2_text' => '',
            'param2' => '',
            'type_id' => 2,
            'user_id' => auth()->user()->id,
            'active' => 1
        ]);
    }

    public function updatePosterAndMedias($exercise_id, $media)
    {
        // dd(is_string($poster), $medias);

        if(!is_string($media)){
            self::find($exercise_id)->medias()->delete();
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

        // if(!empty($medias)){
        //     // Upload medias
        //     $skip_medias = [];
        //     foreach(self::find($exercise_id)->medias()->get() as $existing_media){
        //         // dd(self::find($article_id)->medias()->get(), $medias);
        //         foreach($medias as $media){
        //             if(is_string($media) && $media == $existing_media->media_url){
        //                 $skip_medias[] = $media;
        //             }
        //             else{
        //                 $existing_media->delete();
        //                 Storage::disk('webapp-macau-storage')->delete('exercises/'.$exercise_id.'/medias/'.$existing_media->media_url);
        //             }
        //         }
        //     }
        //     // dd('stop', $skip_medias);
        //     // self::find($exercise_id)->medias()->delete();
            

        //     // Storage::disk('webapp-macau-storage')->deleteDirectory('exercises/'.$exercise_id.'/medias');
        //     foreach ($medias as $media) {
                
        //         if(!is_string($media)){
        //             $upload_date = date('Y-m-d_H:i:s_');
        //             $paths = [];

        //             $fileName = $upload_date . $media->getClientOriginalName();

        //             $paths = $media->storeAs('/exercises/'
        //                 . $exercise_id . '/medias', $fileName, 'webapp-macau-storage');

        //             ExerciseMedia::create([
        //                 'exercise_id' => $exercise_id,
        //                 'media_url' => $fileName
        //             ]);
        //         }
        //     }

        // }
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
        
        // Professor filters
        if(!isset($filters['show_all_professors']) && isset($filters['show_professors']) && !empty($filters['show_professors'])){
            $query = $query->whereIn('user_id', $filters['show_professors'])
                                ->where('published', 1);

            if(in_array(auth()->user()->id, $filters['show_professors'])){
                $query = $query->orWhere(function ($query) {
                                $query->where('published', 0)
                                    ->where('user_id', auth()->user()->id);
                        });
            }
        }
        else{
            $query = $query->where(function ($query) {
                        $query->where('published', 1);
                    })->orWhere(function ($query) {
                        $query->where('published', 0)
                            ->where('user_id', auth()->user()->id);
                    });
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

        $skip = $filters['page'] * 4;

        return $query->skip($skip)->paginate(4);
    }
}
