<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'total_preparation_time' => 'required|string',
            'total_price' => 'required|integer',
            'counts' => 'required',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
    }
}
