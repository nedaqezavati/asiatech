<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_order',
            'order_id', 'food_id')
            ->withPivot('counts');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
