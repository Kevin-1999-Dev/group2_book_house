<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::all();
    }
    /**
     * map
     *
     * @param  mixed $order
     * @return array
     */
    public function map($order): array
    {
        $total_amount = 0;
        foreach ($order->book as $book) {
            $total_amount = $total_amount + ($book->price * $book->pivot->quantity);
        }
        foreach ($order->ebook as $ebook) {
            $total_amount = $total_amount + $ebook->price;
        }

        return [
            $order->id,
            $order->user->name,
            $order->status,
            $order->payment->name,
            $total_amount,
        ];
    }
    /**
     * headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'User',
            'Status',
            'Payment',
            'Amount',
        ];
    }
}
