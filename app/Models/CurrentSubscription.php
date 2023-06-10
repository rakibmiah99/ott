<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentSubscription extends Model
{
    use HasFactory;
    protected $table = 'current_subcription';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
    ];
}
