<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_ADDED_TO_CART = 1;
    const STATUS_ORDER_PLACED = 2;
    const STATUS_ORDER_SHIPPED = 3;

    protected $fillable = [
        'user_id',
        'token',
        'car_id',
        'unit_price',
        'quantity'
    ];
    public function car()
    {
        return $this->belongsTo('App\Models\Car','car_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    /**
     * @param int $status
     * @return bool
     */
    static public function IsValidStatus($status) {
        return in_array($status, [self::STATUS_ADDED_TO_CART, self::STATUS_ORDER_PLACED, self::STATUS_ORDER_SHIPPED]);
    }
}
