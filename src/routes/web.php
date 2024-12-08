<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Models\Dish;
use App\Models\DishCategory;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    // redirect to /home
    return redirect()->route("home");
})->name("index");

Route::get("/login", function () {
    return view("home");
})->name("login");

Route::post("/login", [AuthController::class, 'login']);

Route::get('/home', function () {
    $categories = DishCategory::all();
    return view('home', compact("categories"));
})->name("home");

Route::get("/dashboard", function () {
    return view("home");
})->name("dashboard");

Route::get("/register", function () {
    return view("home");
})->name("register");

Route::post("/register", [AuthController::class, 'register']);

Route::get("/logout", [AuthController::class, 'logout'])->name("logout");
Route::get('/receipt/{order_id}', [OrderController::class, 'showReceipt'])->name('receipt.show');
Route::get('/receipt/{order_id}/pdf', [OrderController::class, 'downloadReceiptPdf'])->name('receipt.pdf');

Route::get('/dishes', function () {
    $category_id = request("category_id");
    $category_name = "All Dishes";
    if (!$category_id) {
        $dishes = Dish::all();
    } else {
        $dishes = Dish::where("category_id", $category_id)->get();
        $category_name = DishCategory::find($category_id)->name;
    }


    return view("home", compact("dishes", "category_name"));
})->name("dish.category");


Route::group(['middleware' => 'auth'], function () {
    Route::post('/add/{d_id}', [CartController::class, 'addToCart'])->name("cart.add");
    Route::get('/remove/{d_id}', [CartController::class, 'removeFromCart'])->name("cart.remove");
    Route::get('/checkout', [CartController::class, 'checkout'])->name("cart.checkout");

    Route::get("/orders", [OrderController::class, 'index'])->name("orders");

    Route::get('/order/change-status/{order_id}/{status}', [OrderController::class, 'changeStatus'])->name("orders.change");
    Route::get('/order/delete/{order_id}', [OrderController::class, 'deleteOrder'])->name('orders.delete');

    Route::get("/records", [OrderController::class, 'index'])->name("records");



    Route::get("/menu", function () {
        // Include data from the Dish model
        $dishes = Dish::all();
        return view("home", compact("dishes"));
    })->name("menu");

    Route::get('e-wallet/pay', [PaymentController::class, 'pay'])->name('ewallet.pay');

    Route::get('/success', function () {
        $cart = session('cart');
        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => json_encode($cart),
            'status' => 'pending',
            'total' => array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cart)),
            'payment_method' => 'gcash',
            'payment_status' => 'paid',
            'address' => User::find(Auth::id())->address,
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
    })->name('menu.success');

    Route::get('/failed', function () {
        return redirect()->route('menu')->with('error', 'Order failed!');
    })->name('menu.failed');
});

// Admin routes
Route::get("/admin", function () {
    return redirect()->route("admin.login");
})->name("admin.home");

Route::get("/admin/login", function () {
    if (Auth::user()) {
        return redirect()->route("admin.dashboard");
    }
    return view("admin");
})->name("admin.login");

Route::group(['middleware' => 'auth'], function () {
    Route::get("/admin/employee/all", [UserController::class, 'all_cashier'])->name("admin.user.all");
    Route::get("/admin/customer/all", [UserController::class, 'all_customer'])->name("admin.user.customer.all");

    Route::get("/admin/employee/add", function () {
        return view("admin");
    })->name("admin.user.add");

    Route::get("/admin/");

    Route::get("/admin/employee/{id}", function ($id) {
        $user = User::query()->find($id);
        return view("admin", compact('user'));
    })->name("admin.user.edit");

    Route::get("/admin/dashboard", [OrderController::class, 'dashboard_view'])->name("admin.dashboard");

    Route::post("/admin/employee/add", [UserController::class, 'add'])->name("employee.add");
    Route::post("/admin/employee/{id}", [UserController::class, 'update'])->name("employee.update");
    Route::get("/admin/employee/delete/{id}", [UserController::class, 'delete'])->name("employee.delete");

    Route::get("/admin/dish/all", [DishController::class, 'all'])->name("admin.dish.all");
    Route::get("/admin/dish/edit/{id}", [DishController::class, 'update_view'])->name('admin.dish.edit');
    Route::get("/admin/dish/create", [DishController::class, 'create_view'])->name('admin.dish.create');
    Route::get("/admin/dish/category/create", [DishController::class, 'category_create_view'])->name('admin.dish.category.create');

    Route::post("/admin/dish/category/add", [DishController::class, 'add_category'])->name("dish.category.create");
    Route::post("/admin/dish/add", [DishController::class, 'create'])->name("dish.create");
    Route::post("/admin/dish/{id}", [DishController::class, 'update'])->name("dish.update");
    Route::get("/admin/dish/delete/{id}", [DishController::class, 'delete'])->name("dish.delete");

    Route::get('/admin/orders/all', [OrderController::class, 'order_view'])->name("admin.orders");
    Route::get("/admin/orders/restaurant", [OrderController::class, 'order_view_restaurant'])->name("admin.orders.restaurant");
});
