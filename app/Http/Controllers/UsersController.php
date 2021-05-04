<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function signup(Request $request)
    {
        return $request;
        $request->validate([
            'email' => 'required|string|unique:users|email',
        ]);
        User::create($request->all());

        return response()->json([
            'message' => 'Successfully created user!',
        ], 200);
    }
}
