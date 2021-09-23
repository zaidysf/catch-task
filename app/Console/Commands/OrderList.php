<?php

namespace App\Console\Commands;

use App\Models\QueueExportFile;
use Illuminate\Console\Command;

class OrderList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show list of exported order';

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
        $this->table(
            ['ID', 'Date', 'File URL', 'Status'],
            QueueExportFile::all(['id', 'processed_date', 'file_url', 'status'])->toArray()
        );
    }
}
