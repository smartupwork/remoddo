<?php

namespace App\Exports;

use App\Enums\OrderStatus;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentHistoryExport implements FromCollection, WithHeadings
{
    /**
     * @return Collection
     */
    public function collection()
    {
        $orders = auth()->user()->myRequests()->with('renter.info')->where('status', OrderStatus::NEW)->get();

        $result = [];

        $i = 1;
        foreach ($orders as $order) {
            $result[] = [
                '#' => $i,
                'id' => $order->id,
                'renter' => $order->renter->info->full_name,
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
            'RENTER',
            'DATE',
            'STATUS',
            'TOTAL PRICE',
        ];
    }
}
