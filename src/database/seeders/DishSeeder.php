<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\DishCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DishCategory::query()->create([
            'name' => 'Main Course',
            'description' => 'Main Course Dishes',
            'image' => 'main-course.jpg',
        ]);

        DishCategory::query()->create([
            'name' => 'Appetizer',
            'description' => 'Appetizer Dishes',
            'image' => 'appetizer.jpg',
        ]);


        Dish::query()->create([
            'category_id' => 1,
            'name' => 'Beef Steak',
            'description' => 'Grilled beef steak with vegetables',
            'price' => 25.00,
            'image' => 'beef-steak.jpg',
            'stock' => 10,
        ]);

        Dish::query()->create([
            'category_id' => 1,
            'name' => 'Chicken Curry',
            'description' => 'Spicy chicken curry with rice',
            'price' => 15.00,
            'image' => 'chicken-curry.jpg',
            'stock' => 10,
        ]);

        Dish::query()->create([
            'category_id' => 1,
            'name' => 'Grilled Salmon',
            'description' => 'Grilled salmon with vegetables',
            'price' => 20.00,
            'image' => 'grilled-salmon.jpg',
            'stock' => 10,
        ]);

        Dish::query()->create([
            'category_id' => 2,
            'name' => 'Spring Rolls',
            'description' => 'Fried spring rolls with sweet and sour sauce',
            'price' => 10.00,
            'image' => 'spring-rolls.jpg',
            'stock' => 10,
        ]);
    }
}
