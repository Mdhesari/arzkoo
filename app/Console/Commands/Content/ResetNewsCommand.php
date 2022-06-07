<?php

namespace App\Console\Commands\Content;

use App\Models\News;
use Illuminate\Console\Command;

class ResetNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset news db';

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
        News::truncate();

        return 0;
    }
}
