<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionCoupons extends Model
{
    use HasFactory;
    protected $table = 'subscription_coupon';
    public $timestamps = false;
}
