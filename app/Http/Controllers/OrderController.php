<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){

        $orders = Order::all()->sortByDesc('created_at');

        return view('admin.order.index', compact('orders'));
    }

    public function show(string $id){

        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('admin.order.show', compact('order', 'orderItems'));
    }

    public function edit(string $id){
        return view('admin.order.edit');
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        if( Auth::user()->role->role_name == 'cashier'){
            $order->status = 'cooked';
        }else{
            $order->status = 'settlement';
        }

        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Status pesanan berhasil diperbarui');
    }


    public function settlement($id)
    {
        $order = Order::findOrFail($id);

        // Update order status to 'settlement'
        $order->status = 'settlement';
        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pembayaran tunai berhasil');
    }

    public function  cooked($id)
    {
        $order = Order::findOrFail($id);

        // Update order status to 'cooked'
        $order->status = 'cooked';
        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan sedang diproses (dimasak)');
    }

}
