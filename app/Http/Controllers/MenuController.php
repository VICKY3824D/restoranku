<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;


class MenuController extends Controller
{
    public function index(Request $request): View{

        $tableNumber = $request->query('meja');
        if($tableNumber){
            Session::put('tableNumber', $tableNumber);
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get();

        return view('customer.menu', compact('items', 'tableNumber'));
    }

    public function cart(): View{

        $cart = Session::get('cart');

        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request): JsonResponse{

        $menuId = $request->input('id');
        $menu = Item::find($menuId);

        if(!$menu){
            return response()->json([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        $cart = Session::get('cart', []);

        if(isset($cart[$menuId])){
            $cart[$menuId]['qty']++;
        } else {
            $cart[$menuId] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->img, // Changed 'img' to 'image' to match cart view
                'qty' => 1
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu berhasil ditambahkan ke keranjang'
        ], 200);
    }

    public function updateCart(Request $request){
        $itemId = $request->input('id');
        $newQty = $request->input('qty');

        if ($newQty <= 0){
            return response()->json([
                'success' => false,
                'message' => 'Jumlah tidak boleh kurang dari 1'
            ]);
        }

        $cart = Session::get('cart', []);
        if(isset($cart[$itemId])){
            $cart[$itemId]['qty'] = $newQty;
            Session::put('cart', $cart);
            Session::flash('success', 'Jumlah menu berhasil diperbarui');

            return response()->json(["success" => true]);
        }
    }

    public function removeCart(Request $request){
        $itemId = $request->input('id');
        $cart = Session::get('cart', []);

        if(isset($cart[$itemId])){
            unset($cart[$itemId]);
            Session::put('cart', $cart);
            Session::flash('success', 'Menu berhasil dihapus dari keranjang');

            return response()->json(["success" => true]);
        }
    }

    public function clearCart(){
        Session::forget('cart');
        return redirect()->route('cart.')->with('success', 'Keranjang berhasil dibersihkan');
    }

}
