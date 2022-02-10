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

        foreach ($exames as $exame) {
            if($exame->id != 484){
                continue;
            }
            Storage::disk('webapp-macau-storage')->deleteDirectory('student_exames/15/exame/' . $exame->id);
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
