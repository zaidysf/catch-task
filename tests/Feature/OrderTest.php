<?php

namespace Tests\Feature;

use App\Exports\Order\Order;
use App\Jobs\Order\UpdateDBAfterExport;
use App\Models\QueueExportFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Feature test to make sure that export order list page shown successfully.
     *
     * @return void
     */
    public function test_user_can_view_export_order_list()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_process_order_export()
    {
        // Storage::fake('public');
        $countIDB = QueueExportFile::all()->count();
        $initStorage = Storage::disk('public')->files('/');
        $countIS = count(array_filter($initStorage,function($a) {return str_contains($a, '.csv');}));

        $response = $this->get('/export');

        $response->assertStatus(200);

        $latestDB = QueueExportFile::all()->count();
        $latestStorage = Storage::disk('public')->files('/');
        $countLS = count(array_filter($latestStorage,function($a) {return str_contains($a, '.csv');}));

        if (
            $countLS - $countIS == 1 &&
            $latestDB - $countIDB == 1 &&
            QueueExportFile::orderBy('id', 'desc')->first()->status == 1
        ) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function test_user_can_process_order_export_via_console()
    {
        $countIDB = QueueExportFile::all()->count();
        $initStorage = Storage::disk('public')->files('/');
        $countIS = count(array_filter($initStorage,function($a) {return str_contains($a, '.csv');}));

        $this->artisan('order:export')
            ->expectsOutput('Export started!')
            ->assertExitCode(0);

        $latestDB = QueueExportFile::all()->count();
        $latestStorage = Storage::disk('public')->files('/');
        $countLS = count(array_filter($latestStorage,function($a) {return str_contains($a, '.csv');}));

        if (
            $countLS - $countIS == 1 &&
            $latestDB - $countIDB == 1 &&
            QueueExportFile::orderBy('id', 'desc')->first()->status == 1
        ) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }
    }

    public function test_user_can_view_export_order_list_via_console()
    {
        $this->artisan('order:list')
            ->expectsTable([
                'ID',
                'Date',
                'File URL',
                'Status'
            ], QueueExportFile::all(['id', 'processed_date', 'file_url', 'status'])->toArray());
    }
}
