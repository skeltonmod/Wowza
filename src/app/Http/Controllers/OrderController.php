<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        // Get only the authenticated user ID
        $user = User::query()->find(Auth::id());
        if ($user->hasRole('user')) {
            $orders = Order::with('dishes')->where('user_id', '=', Auth::id())->get();
        } elseif ($user->hasRole('cashier')) {
            $orders = Order::with('dishes')->get();
        }

        return view('home', compact('orders'));
    }

    public function order_view()
    {
        $orders = Order::with('dishes')->with('user')->where('payment_method', '=', 'gcash')->get();

        return view("admin", compact('orders'));
    }

    public function order_view_restaurant(){
        $orders = Order::with('dishes')->with('user')->where('payment_method', '=', 'cash')->get();

        return view("admin", compact('orders'));
    }

    public function dashboard_view()
    {
        $orders = [
            'today' => Order::tallyOrdersByDay(),
            'month' => Order::tallyOrdersByMonth(),
            'year' => Order::tallyOrdersByYear(),
            'dishes' => Dish::all()->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'completed' => Order::where('status', 'delivered')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];
        return view("admin", compact('orders'));
    }

    public function showReceipt($order_id)
    {
        $order = Order::with(['dishes', 'user'])->findOrFail($order_id);
        return view('receipt', compact('order'));
    }

    public function downloadReceiptPdf($order_id)
    {
        $order = Order::findOrFail($order_id);
        $pdf = PDF::loadView('receipt', compact('order'));
        return $pdf->download('receipt-' . $order->id . '.pdf');
    }

    public function cancelOrder($order_id)
    {
        $order = Order::query()->find($order_id);
        $order->update([
            'status' => 'rejected'
        ]);
        return view('home', compact(Order::with('dishes')->get()));
    }

    public function changeStatus($order_id, $status)
    {
        $order = Order::query()->find($order_id);
        $order->update([
            'status' => $status
        ]);
        $new_orders = Order::with('dishes')->get();
        return redirect()->route('records')->with(compact('new_orders'));
    }

    public function deleteOrder($order_id)
    {
        $order = Order::query()->findOrFail($order_id);
        $order->delete();
        return redirect()->route('orders');
    }
}
