<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;

class AdminController extends Controller
{
    public function index()
    {
        $resTotalTrx = Transaction::selectRaw('DATE_FORMAT(TransDate, "%b") as month, COUNT(ID) as totalTrx, SUM(Subtotal) as subtotal, SUM(Discount) as discount, SUM(Total) as total')
            ->whereBetween('TransDate', ['2023-07-01 00:00:00', '2023-12-31 00:00:00'])
            ->groupBy('month')
            ->orderByRaw('MONTH(TransDate)')
            ->getQuery()
            ->get();

        $totalTrx = [];
        $subtotal = [];
        $discount = [];
        $total = [];
        for ($i = 0; $i < 6; $i++) {
            $totalTrx[] = $resTotalTrx[$i]->totalTrx ?? 0;
            $subtotal[] = $resTotalTrx[$i]->subtotal ?? 0;
            $discount[] = $resTotalTrx[$i]->discount ?? 0;
            $total[] = $resTotalTrx[$i]->total ?? 0;
        }

        return view('admin.index', ['totalTrx' => json_encode($totalTrx), 'subtotal' => json_encode($subtotal), 'discount' => json_encode($discount), 'total' => json_encode($total)]);
    }
}
