<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    //
    public function create_view()
    {
        $categories = DishCategory::all();
        return view('admin', compact('categories'));
    }

    public function category_create_view()
    {
        return view('admin');
    }

    public function update_view($id)
    {
        $dish = Dish::query()->findOrFail($id);
        $categories = DishCategory::all();
        return view('admin', compact('dish', 'categories'));
    }

    public function fetch(Request $request)
    {
        
        $categories = DishCategory::all();
        $category_id = $request->input('category_id');
        if ($category_id) {
            $dishes = Dish::where('category_id', $category_id)->get();
        } else {
            $dishes = Dish::all();
        }
        return view("home", compact("dishes", "categories", "category_id"));
    }

    public function all()
    {
        $dishes = Dish::query()->with('category')->get();
        return view('admin', compact('dishes'));
    }

    public function create(Request $request)
    {
        // Create validation
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save the image to the public folder
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        Dish::query()->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'stock' => $request->stock,
        ]);
        return redirect()->route('admin.dish.all')->with('success', 'Dish added successfully');
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);

        // Create validation
        $validator = Validator::make(request()->all(), [
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->image) {
            // Delete the old image
            if (file_exists(public_path('images/' . $dish->image))) {
                unlink(public_path('images/' . $dish->image));
            }

            // Save the new one lmao
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
        }else {
            $imageName = $dish->image;
        }

        $dish->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $imageName,
            'stock' => $request->input('stock'),
        ]);

        return redirect()->route('admin.dish.all')->with('success', 'Dish updated successfully');
    }

    public function delete($id)
    {
        $dish = Dish::query()->findOrFail($id);
        if (file_exists(public_path('images/' . $dish->image))) {
            unlink(public_path('images/' . $dish->image));
        }
        $dish->delete();
        return redirect()->route('admin.dish.all')->with('success', 'Dish deleted successfully');
    }

    public function add_category(Request $request)
    {
        // Create validation
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save Image
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        $category = DishCategory::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.dish.all')->with('success', 'Category added successfully');
    }
}
