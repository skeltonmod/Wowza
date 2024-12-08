<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Luigel\Paymongo\Facades\Paymongo;

class PaymentController extends Controller
{
    //
    public function pay(Request $request)
    {
        // Get cart data from session
        $cart = session('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $source = Paymongo::source()->create([
            'type' => 'gcash',
            'amount' => $total, // Convert to cents
            'currency' => 'PHP',
            'redirect' => [
                'success' => route('menu.success'),
                'failed' => route('menu.failed'),
            ],
            'billing' => [
                'address' => $request->address,
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ]
        ]);

        Log::info('src id ' . $source->id);

        return redirect($source->getRedirect()['checkout_url']);
    }
}
