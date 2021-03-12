<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AutoController;

class LessonBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lesson_finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'lesson finish';

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
     * @return int
     */
    public function handle()
    {
        AutoController::lesson_finish();
    }
}
