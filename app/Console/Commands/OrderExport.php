<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export response of API to csv file';

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
        app('App\Http\Controllers\Order\OrderController')->export();
        $this->info("Export started!");
    }
}
