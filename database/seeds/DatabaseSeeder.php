<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserRoleSeed::class);
        // $this->call(UniversitySeed::class);
        // $this->call(ArticleCategoriesSeed::class);
        // $this->call(TagsSeed::class);

        // $this->call(ExerciseCategoriesSeed::class);
        // $this->call(ExerciseLevelsSeed::class);

        // $this->call(NotificationTypesSeed::class);

        // $this->call(QuestionTypesSeed::class);
        // $this->call(QuestionSubTypesSeed::class);
        
        $this->call(InquiriesSeeds::class);
    }
}
