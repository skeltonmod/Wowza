<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'payment_status',
        'address',
        'order_items',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class)->withPivot('quantity');
    }

    public static function tallyOrdersByDay()
    {
        return self::whereDate('created_at', Carbon::today())->sum('total');
    }

    public static function tallyOrdersByMonth()
    {
        return self::whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->sum('total');
    }

    public static function tallyOrdersByYear()
    {
        return self::whereYear('created_at', Carbon::now()->year)->sum('total');
    }
}
