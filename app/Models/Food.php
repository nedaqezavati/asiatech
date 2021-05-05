<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'history',
        'quantity',
        'preparation_time',
        'status',

    ];

    protected $table = 'foods';

    CONST IRANIAN            = 0;
    CONST FAST_FOOD          = 1;
    CONST INTERNATIONAL      = 2;

    public function orders()
    {
        return $this->belongsToMany(Order::class,
            'food_order', 'order_id', 'food_id')
            ->withPivot('counts');
    }

    public static function types()
    {
        return [
            static::IRANIAN         => 'Iranian',
            static::FAST_FOOD       => 'Fast_Food',
            static::INTERNATIONAL   => 'International'
        ];
    }
}
