<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // ...

    public function addToCart(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|numeric|min:1',
    ]);

    if (!$request->has('toko_id')) {
        return redirect()->back()->with('error', 'Tidak dapat menambahkan item ke keranjang. Silakan coba lagi.');
    }

    $cart = Session::get('cart', []);

    if (isset($cart[$request->toko_id])) {
        $cart[$request->toko_id]['quantity'] += $request->quantity;
    } else {
        $cart[$request->toko_id] = [
            'toko_id' => $request->toko_id,
            'quantity' => $request->quantity,
        ];
    }

    Session::put('cart', $cart);

    Cart::updateOrCreate(
        ['toko_id' => $request->toko_id],
        ['quantity' => $request->quantity]
    );

    return redirect()->back()->with('success', 'Item berhasil ditambahkan ke keranjang.');
}




public function viewCart()
{
    $cartItems = [];

    foreach (Session::get('cart', []) as $id => $cartItem) {
        $toko = toko::find($cartItem['toko_id']);
        if ($toko) {
            $cartItems[] = [
                'id' => $id,
                'toko' => $toko,
                'quantity' => $cartItem['quantity'],
            ];
        }
    }

    return view('cart.index', compact('cartItems'));
}


    public function checkout()
    {
        return view('cart.checkout');
    }

    public function updateCartQuantity(Request $request)
    {
        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');
    
        $cartItems = Session::get('cart', []);
    
        if (array_key_exists($itemId, $cartItems)) {
            $cartItems[$itemId]['quantity'] = $quantity;
            Session::put('cart', $cartItems);
            Cart::where('toko_id', $cartItems[$itemId]['toko_id'])
                ->update(['quantity' => $quantity]);
    
            return response()->json(['message' => 'Jumlah diperbarui dengan sukses']);
        }
    
        return response()->json(['message' => 'Gagal memperbarui jumlah']);
    }
    

public function addToCartFromToko(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|numeric|min:1',
        'toko_id' => 'required|numeric',
    ]);

    $cart = Session::get('cart', []);

    if (isset($cart[$request->toko_id])) {
        $cart[$request->toko_id]['quantity'] += $request->quantity;
    } else {
        $cart[$request->toko_id] = [
            'toko_id' => $request->toko_id,
            'quantity' => $request->quantity,
        ];
    }

    Session::put('cart', $cart);
    Cart::updateOrCreate(
        ['toko_id' => $request->toko_id],
        ['quantity' => $request->quantity]
    );

    return redirect()->route('cart.view')->with('success', 'Item berhasil ditambahkan ke keranjang.');
}

public function removeItem($id)
{
    $cart = Session::get('cart', []);
    if (isset($cart[$id])) {
        unset($cart[$id]);
        Session::put('cart', $cart);
        Cart::where('toko_id', $id)->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang');
    }

    return redirect()->back()->with('error', 'Item tidak ditemukan dalam keranjang.');
}
}
