<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()) {
            $redirect_to = route('carts.index');
            return redirect()->route('login', ['redirect' => $redirect_to]);
        }

        $cartItems = CartItem::where('user_id', Auth::id())
                        ->with('product')
                        ->get();
        return view('carts.index', ['title' => 'Carts'], compact('cartItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $product = Product::findOrFail($request->input('product_id'));
        if(!Auth::check()) {
            $redirect_to = route('products.show', $product->slug);
            return redirect()->route('login', ['redirect' => $redirect_to]);
        }

        CartItem::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
        ])->fill([
            'quantity' => $request->input('quantity', 1),
        ])->save();

        return redirect()->route('carts.index')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);
        if($cartItem->user_id !== Auth::id()) {
            return redirect()->route('carts.index')->with('error', 'You are not authorized to update this cart item.');
        }
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->route('carts.index')->with('success', 'Cart item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);
        if($cartItem->user_id !== Auth::id()) {
            return redirect()->route('carts.index')->with('error', 'You are not authorized to delete this cart item.');
        }
        $cartItem->delete();
        return redirect()->route('carts.index')->with('success', 'Cart item deleted successfully.');
    }
}
