<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function all_customer(){
        $users = User::query()->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["user"]);
        })->where("id", "!=", Auth::id())->get();
        $title = "Customers";
        return view("admin", compact("users", "title"));
    }

    public function all_cashier(){
        $users = User::query()->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["cashier"]);
        })->where("id", "!=", Auth::id())->get();
        $title = "Cashiers";
        return view("admin", compact("users", "title"));
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.user.add')
                ->withErrors($validator)
                ->withInput();
        }

        // Log the request
        Log::info('User passed the validation');

        // Create a faker username
        $username = Str::lower($request->first_name) . Str::lower($request->last_name) . rand(100, 999);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'username' => $username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make('defaultpassword'),
        ]);

        $user->assignRole('cashier');

        return redirect()->route('admin.user.all')->with('success', 'User added successfully');
    }

    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'nullable|string',
        ]);

        $employee->update($request->all());

        return redirect()->route('admin.user.all')->with('success', 'User updated successfully');
    }

    public function delete($id){
        $user = User::query()->findOrFail($id);

        $user->delete();

        return redirect()->route('admin.user.all')->with('success', 'User deleted successfully');
    }
}
