<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $cashier = User::role('cashier')->with('roles')->count();
        $sale = SaleDetail::count();

        $monthlySalesRaw = SaleDetail::selectRaw('MONTH(sales.created_at) as month, SUM(sub_total) as total')
            ->join('sales', 'sales.id', '=', 'sale_details.sale_id')
            ->groupBy(DB::raw('MONTH(sales.created_at)'))
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlySales[] = $monthlySalesRaw[$i] ?? 0;
        }

        return view('admin.index', compact('cashier', 'sale', 'monthlySales'));
    }


    public function cashiers()
    {
        return view('admin.cashier.index');
    }

    public function pill()
    {
        return view('admin.pill.index');
    }

    public function history()
    {
        return view('admin.history.index');
    }
}
