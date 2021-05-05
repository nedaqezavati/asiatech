<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request, [
            'is_delivered' => 'nullable'
        ]);
        $orders = [];
        $counts = [];
        $preparationTime = [];
        $totalPrice = null;


//        Log::debug($request);

        $orders = collect($request);
        Log::debug($orders);

        foreach($orders as $order) {
            Log::debug($order);
            $food = Food::where('id', $order['id'])->first();
            Log::debug($food);
            $totalPrice = $totalPrice + ( $food->price * $order['counts'] );
            $counts[$order['id']] = $order['counts'];
            $preparationTime[] = $food->preparation_time;
        }

        $preparationTime = max($preparationTime);

        $order = new Order();
        $order->user_id = 1;
        $order->total_price = $totalPrice;
        $order->total_preparation_time = $preparationTime;
        $order->save();

        $order->foods()->sync($orders, false);

        return response()->json([
            'message' => 'Successfully created order!'
        ], 201);
    }
}
