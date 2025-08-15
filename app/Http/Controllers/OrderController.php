<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::all()->sortByDesc('created_at');

        return view('admin.order.index', compact('orders'));
    }

    public function edit(string $id){
        return view('admin.order.edit');
    }
}
