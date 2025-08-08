<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CheckoutController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkout(){
        $cart = session()->get('cart');

        if(!$cart){
            return redirect()->route('cart.')
                ->with('error', 'Keranjang kosong');
        }

        $tableNumber = session()->get('tableNumber');

        return view('customer.checkout', compact('cart', 'tableNumber'));
    }

    public function  storeOrder(CheckoutRequest $request)
    {
        $cart = Session::get('cart');
        $tableNumber = Session::get('tableNumber');


        if(empty($cart)){
            return redirect()->route('cart.')->with('error', 'Keranjang kosong');
        }

        $itemIds = collect($cart)->pluck('id');

        // Retrieve all prices from the database in a single query
        $prices = Item::whereIn('id', $itemIds)
            ->where('is_active', true)
            ->pluck('price', 'id'); // [id => price]

        // Calculate the total and prepare the itemDetails
        $totalAmount = 0;
        $itemDetails = [];

        foreach ($cart as $item) {
            $price = $prices[$item['id']]; // take from query results
            $subtotal = $price * $item['qty'];
            $totalAmount += $subtotal;

            $itemDetails[] = [
                'id' => $item['id'],
                'price' => (int) ($price + ($price * 0.1)),
                'quantity' => $item['qty'],
                'name' => substr($item['name'], 0, 50),
            ];
        }

        // save order
        $validated_data = $request->validated();
        $user = User::firstOrCreate([
            'fullname' => $validated_data['fullname'],
            'phone' => $validated_data['phone'],
            'role_id' => 4,
        ]);

        $order = Order::create([
            'order_code' => 'ORD-' . $tableNumber . '-' . time(),
            'user_id' => $user->id,
            'subtotal' => $totalAmount,
            'tax' => $totalAmount * 0.1,
            'grand_total' => $totalAmount + ($totalAmount * 0.1),
            'status' => 'pending',
            'table_number' => $tableNumber,
            'payment_method' => $validated_data['payment_method'],
            'notes' => $request->notes
        ]);

        // Simpan order items
        foreach ($cart as $item) {
            $price = $prices[$item['id']];
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $price * $item['qty'],
                'tax' => $item['qty'] * $price * 0.1,
                'total_price' => ($price * $item['qty']) + ($price * $item['qty'] * 0.1),
            ]);
        }

        Session::forget('cart');

        return redirect()->route('checkout.success', ['orderCode' => $order->order_code])
            ->with('success', 'Pesanan berhasil dibuat');
    }

    public function  orderSuccess($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return redirect()->route('menu')->with('error', 'Pesanan tidak ditemukan');
        }

        $orderItems = OrderItem::where('order_id', $order->id)->get();

        if ($order->payment_method == 'qris'){
            $order->status = 'settlement';
            $order->save();
        }

        return view('customer.success', compact('order', 'orderItems'));
    }
}
