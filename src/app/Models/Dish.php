<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
    ];

    public function category(){
        return $this->belongsTo(DishCategory::class);
    }
}
