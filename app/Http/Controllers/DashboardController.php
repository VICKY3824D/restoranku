<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public  function index(){
        $totalOrders = Order::where('status', '=', 'cooked')->count();
        $totalRevenue = Order::where('status', '=', 'cooked')->sum('grand_total');

        $todayOrders = Order::whereDate('created_at', today())
                            ->where('status', '=', 'cooked')
                            ->count();
        $todayRevenue = Order::whereDate('created_at', today())
                            ->where('status', '=', 'cooked')
                            ->sum('grand_total');

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'todayOrders', 'todayRevenue'));

    }
}
