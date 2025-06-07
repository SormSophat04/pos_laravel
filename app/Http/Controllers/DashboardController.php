<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    public function index()
    {
        return view('layout.dashboard');
    }

    public function getOrders()
    {
        $orderss = SaleItem::orderBy('created_at', 'desc')->get();
        $orders = Sale::join('sale_items', 'sales.id', '=', 'sale_items.sale_id')
            ->join('users', 'sales.cashier_id', '=', 'users.id')
            ->select(
                'sales.id as sale_id',
                'sale_items.id as item_id',
                'sale_items.product_name',
                'sale_items.quantity',
                'sale_items.price',
                'sale_items.total as item_total',
                'sales.total as sale_total',
                'sales.cash_received',
                'sales.change',
                'sales.payment_type',
                'sales.created_at',
                'users.name as cashier_name'
            )
            ->orderBy('sales.created_at', 'desc')
            ->get();
        $products = Product::all();
        $cashiers = User::all();
        $customers = Sale::query()
            ->selectRaw('COUNT(DISTINCT id) as total_customers')
            ->first();
        $total_amount = Sale::query()
            ->selectRaw('SUM(total) as total_amount')
            ->first();
        $result = SaleItem::query()
            ->selectRaw('SUM(total) as total_balance, COUNT(DISTINCT id) as total_orders')
            ->first();
        $stock = Product::query()->selectRaw('COUNT(DISTINCT qty) as total_stocks')
            ->first();

        $stocks = $stock->total_stocks;
        $totalCustomers = $customers->total_customers;
        $totalBalance = $result->total_balance;
        $totalOrders = $result->total_orders;
        $totalAmount = $total_amount->total_amount;

        return view('layout.dashboard', compact('orders', 'products', 'totalAmount', 'totalOrders', 'totalCustomers', 'stocks', 'cashiers', 'totalBalance'));
    }
}
