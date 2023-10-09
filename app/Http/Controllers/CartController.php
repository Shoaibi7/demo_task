<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
{
    $cartItems = Cart::all(); 
  
    $total=0; 

    return view('cart.cart', compact('cartItems', 'total'));
}

    public function addToCart(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;    
        $product = Product::find($request->input('product_id'));
        // dd($product);
        Cart::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
        // Cart::add($product->id, $product->name, 1, $product->price);

        return redirect()->route('cart')->with('success', 'Product added to cart');
    }

    public function showCart()
    {
        $items = Cart::getContent();

        return view('cart.index', compact('items'));
    }

    public function checkout()
    {
        // Process the checkout here (e.g., charge the user)
        return 'tripe';
        // Clear the cart after successful checkout
        Cart::clear();

        return redirect()->route('products')->with('success', 'Checkout successful');
    }
}
