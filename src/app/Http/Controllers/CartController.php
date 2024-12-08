<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function addToCart(Request $request, $d_id)
    {
        $product = Dish::find($d_id); // Find the product from the database
        $quantity = $request->input('quantity');

        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock for '. $product->name);
        }

        $cart = session()->get('cart', []);

        $itemKey = array_search($d_id, array_column($cart, 'd_id'));
        if ($itemKey !== false) {
            $cart[$itemKey]['quantity'] += $quantity;
        } else {
            $cart[] = [
                'd_id' => $d_id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        

        // Update the session
        session(['cart' => $cart]);

        return redirect()->route('menu')->with('success', 'Item added to cart!');
    }

    public function removeFromCart($d_id)
    {
        $cart = session('cart');
        foreach ($cart as $index => $item) {
            if ($item['d_id'] == $d_id) {
                unset($cart[$index]);
                break;
            }
        }

        session(['cart' => array_values($cart)]);

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function checkout()
    {
        $cart = session('cart');
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => json_encode($cart),
            'status' => 'pending',
            'total' => array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
            'address' => User::query()->find(Auth::id())->address,
        ]);
        
        foreach ($cart as $item) {
            $order->dishes()->attach($item['d_id'], ['quantity' => $item['quantity']]);

            // Update the stock of the dish
            $dish = Dish::find($item['d_id']);
            $dish->stock -= $item['quantity'];
            $dish->save();
        }
        session(['cart' => []]); // Empty the cart after checkout
        return redirect()->route('menu')->with('success', 'Order placed successfully!');
    }
}
