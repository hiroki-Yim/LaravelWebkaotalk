<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\User;
use App\Borad;

class notifyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:message'; //php artisan notify:message

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
        Log::info('scheduler time check : '.now());
        // $board = new Board();
        // $board->title = str_random(10);
        // $board->author = \Auth::user()->nickname;
        // $board->content = str_random(50);
        // $board->save();

    }
}
