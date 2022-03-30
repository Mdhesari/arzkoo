<?php

namespace App\Console\Commands\Content\Exchange\Exchange\Arzkoo\Arzkoo\Mail\Content\Mail;

use App\Models\EmailSubscription;
use Illuminate\Console\Command;

class ResetMailSubscriptionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arzkoo:reset-mail-subscriptions';

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
     * @return int
     */
    public function handle()
    {
        EmailSubscription::where('id', '>', 0)->delete();

        return 0;
    }
}
