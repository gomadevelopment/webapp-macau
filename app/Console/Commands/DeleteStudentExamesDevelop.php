<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Exame;
use Illuminate\Support\Facades\Storage;


class DeleteStudentExamesDevelop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:student_exames_develop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $exames = Exame::get();
        Storage::disk('webapp-macau-storage')->deleteDirectory('student_exames');
        foreach ($exames as $exame) {
            // if($exame->id != 230){
            //     continue;
            // }
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
            $exame->delete();
        }
    }
}
