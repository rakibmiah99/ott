<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionBuyHistory extends Model
{
    use HasFactory;
    protected $table = 'subscription_buy_history';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'user_id'
    ];
}
