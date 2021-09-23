<?php

namespace App\Console\Commands;

use App\Models\QueueExportFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class OrderCsvValidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:csv-validate {id : The ID of the exported order}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate the exported CSV by ID';

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
        $check = QueueExportFile::find($this->argument('id'));
        if ($check) {
            $validate = Http::get($check->csvlint_url.'.json')['package']['validations'];
            if (empty($validate)) {
                $this->info('Your csv file is still validating, please try again later');
            } else {
                $this->success($validate[0]['state']);
            }
        } else {
            $this->error('ID not found');
        }
    }
}
