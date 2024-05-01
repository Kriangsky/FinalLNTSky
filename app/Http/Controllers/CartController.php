<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Receipt;

class CartController extends Controller
{
    public function showCart()
    {
        $carts = Cart::with('item')->get();

        return view('cart', compact('carts'));
    }

    public function showReceipt()
    {
        $userId = auth()->user()->id;
    
        $carts = Cart::with('item')->where('user_id', $userId)->where('status', 'bought')->get();
    
        return view('receipt', compact('carts'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->item_id = $request->item_id;
        $cart->total_items = $request->quantity;
        $cart->status = "active";
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function delete($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'postalCode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
    
        $userId = auth()->user()->id;
        
        Cart::where('user_id', $userId)
            ->where('status', 'active')
            ->update([
                'status' => 'bought',
                'address' => $validatedData['address'],
                'postal_code' => $validatedData['postalCode']
            ]);
    
        return redirect()->route('show')->with('success', 'Checkout successful!');
    }
    
}
