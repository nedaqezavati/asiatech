<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FoodsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30|unique:foods|string',
            'type' => 'required|between:0,2|integer',
            'price' => 'required|integer',
            'history' => 'nullable',
            'quantity' => 'integer|required',
//            'preparation_time' => 'required',
            'status' => 'required',
        ]);
        $food = new Food([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'history' => $request->history,
            'quantity' => $request->quantity,
            'preparation_time' => Carbon::createFromTime($request->hours, $request->minutes, $request->seconds)->format("H:i:s"),
            'status' => $request->status,
        ]);

        $food->save();

        return response()->json([
            'message' => 'Successfully created food!'
        ], 201);
    }

    public function index()
    {
        $foods = Food::all();

        return response()->json($foods);
    }
}
