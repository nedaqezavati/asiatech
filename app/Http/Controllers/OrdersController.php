<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'is_delivered' => 'nullable'
        ]);
        $foodIds = [];
        $preparationTime = [];
        $totalPrice = null;

        $orders = collect($request);

        foreach($orders as $order) {
            $food = Food::where('id', $order['id'])->first();
            $totalPrice = $totalPrice + ( $food->price * $order['counts'] );
            $foodIds[] = $order['id'];
            $preparationTime[] = $food->preparation_time;
        }

        $preparationTime = max($preparationTime);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->total_price = $totalPrice;
        $order->total_preparation_time = $preparationTime;
        $order->save();

        $order->foods()->attach($foodIds);

        return response()->json([
            'message' => 'Successfully created order!',
            'preparation' => $preparationTime
        ], 201);
    }

    public function userOrders()
    {
        $userOrders = Auth::user()->orders()->get();

        return response()->json($userOrders);
    }
}
