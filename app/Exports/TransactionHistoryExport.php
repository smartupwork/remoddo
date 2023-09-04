<?php

namespace App\Exports;

use App\Enums\OrderStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionHistoryExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        $orders = auth()->user()->myRequests()->where('status', OrderStatus::ACCEPTED)->get();

        $result = [];

        $i = 1;
        foreach ($orders as $order) {
            $result[] = [
                '#' => $i,
                'id' => $order->id,
                'date' => $order->start_date,
                'status' => 'Pending',
                'total_price' => $order->total_price,
            ];
            $i++;
        }

        return collect($result);
    }

    public function headings(): array
    {
        return [
            '#',
            'ID',
            'DATE',
            'STATUS',
            'TOTAL PRICE',
        ];
    }
}
