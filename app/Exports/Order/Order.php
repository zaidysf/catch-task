<?php

namespace App\Exports\Order;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Throwable;

class Order implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    protected $orders;
    protected $time;
    protected $fileUrl;

    public function __construct($orders, $time, $fileUrl)
    {
        $this->orders = $orders->resource;
        $this->time = $time;
        $this->fileUrl = $fileUrl;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return $this->orders;
    }

    public function map($orders): array
    {
        $dataCount = $this->getCountAll($orders['items'], $orders['discounts']);
        return [
            $orders['order_id'],
            date(DATE_ISO8601, strtotime($orders['order_date'])),
            $dataCount['total'],
            $dataCount['average'],
            $dataCount['count'],
            $dataCount['count_all'],
            $orders['customer']['shipping_address']['state'],
        ];
    }

    public function headings(): array
    {
        return [
            'order_id',
            'order_datetime',
            'total_order_value',
            'average_unit_price',
            'distinct_unit_count',
            'total_units_count',
            'customer_state',
        ];
    }

    public function failed(Throwable $exception): void
    {
        app('App\Http\Controllers\Order\OrderController')->jobStatus($this->time, $this->fileUrl, 2);
    }

    protected function getCountAll($items, $discounts): array
    {
        $averageValue = 0;
        $totalValue = 0;
        $totalUnit = 0;
        $totalItem = 0;
        if (!empty($items)) {
            $totalValueForAvg = 0;
            foreach ($items as $v) {
                $totalValue += $v['quantity'] * $v['unit_price'];
                $totalValueForAvg += $v['unit_price'];
                $totalUnit += $v['quantity'];
                $totalItem++;
            }
            if ($totalValue > 0 && !empty($discounts)) {
                foreach ($discounts as $v) {
                    switch ($v['type']) {
                        case 'PERCENTAGE':
                            $totalValue = $totalValue - ($totalValue * $v['value'] / 100);
                            break;

                        // DOLLAR
                        default:
                            $totalValue -= $v['value'];
                            break;
                    }
                }
            }
            $averageValue = $totalValueForAvg / $totalItem;
        }
        return [
            'total' => number_format($totalValue, 2),
            'average' => number_format($averageValue, 2),
            'count' => $totalUnit,
            'count_all' => $totalItem,
        ];
    }
}
