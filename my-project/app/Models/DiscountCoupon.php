<?php

namespace App\Models;

use Database\Factories\DiscountCouponFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;

    protected $factory = DiscountCouponFactory::class;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_discount_coupon');
    }
}
