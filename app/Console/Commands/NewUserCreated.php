<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NewUserCreated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todaysuser:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Todays user';

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
        $count = \DB::table('users')
        ->whereDate('created_at', '=', date('Y-m-d'))
        ->count();
        dd("Todays {$count}");
        
        return 0;
    }
}
