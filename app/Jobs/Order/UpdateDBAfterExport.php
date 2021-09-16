<?php

namespace App\Jobs\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDBAfterExport implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $time;
    public $fileUrl;

    public function __construct($time, $fileUrl)
    {
        $this->time = $time;
        $this->fileUrl = $fileUrl;
    }

    public function handle(): void
    {
        app('App\Http\Controllers\Order\OrderController')->jobStatus($this->time, $this->fileUrl, 1);
    }
}
