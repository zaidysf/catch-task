<?php

namespace App\Http\Controllers\Order;

use App\Exports\Order\Order as OrderExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\DefaultResource;
use App\Jobs\Order\UpdateDBAfterExport;
use App\Models\Order;
use App\Models\QueueExportFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Jobs\QueueExport;

class OrderController extends Controller
{
    public function index(): View
    {
        $data = QueueExportFile::all();
        return view('order.index', compact('data'));
    }

    public function export(): string
    {
        $now = strtotime(now());
        $fileUrl = 'storage/'.$now.'.csv';
        (
            new OrderExport(
                DefaultResource::collection(
                    (new Order())->get()
                )
            , $now, $fileUrl)
        )->queue('public/'.$now.'.csv')->chain([
            new UpdateDBAfterExport($now, $fileUrl),
        ]);
        return 'Export started!';
    }

    public function jobStatus($time, $fileUrl, $status): void
    {
        $csvlint_url = '';
        if ($status == 1) {
            $csvlint_url = Http::post('http://csvlint.io/package.json', [
                'urls' => [url($fileUrl)],
            ])['package']['url'];
        }
        DB::table('queue_export_files')->insert(
            [
                'processed_date' => date('Y-m-d H:i:s', $time),
                'file_url' => $fileUrl,
                'status' => $status,
                'csvlint_url' => $csvlint_url
            ]
        );
    }

    public function validateCsv($id): string
    {
        $check = QueueExportFile::find($id);
        if ($check) {
            $validate = Http::get($check->csvlint_url.'.json')['package']['validations'];
            if (empty($validate)) {
                return "Your csv file is still validating, please try again later";
            } else {
                return $validate[0]['state'];
            }
        }
    }
}
