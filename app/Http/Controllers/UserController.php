<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\History;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|unique:users',
            'password' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = new User();
        $user->login = $request->input('login');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->balance = 0;
        $user->save();

        Auth::login($user);
        if (Auth::check()) {

            return response()->json([

                'message' => 'User registered and logged in successfully',

                'user' => Auth::user()

            ], 201);
        }

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('login', $request->input('login'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
        Auth::login($user);
        if (Auth::check()) {

            return response()->json([

                'message' => 'User logged in successfully',

                'user' => Auth::user()

            ], 201);
        }
        return response()->json(['message' => 'Login successful'], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = Auth::user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return response()->json(['error' => 'Current password is incorrect'], 400);
        }
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function addBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'nickname' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('login', $request->input('nickname'))->first();
        if ($user->balance + $request->input('amount') < 0) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $user->balance += $request->input('amount');
        $user->save();

        $history = new History();
        $history->user_id = $user->id;
        $history->type = "balance";
        $history->status = "success";
        $history->amount = $request->input('amount');
        $history->description = "Пополнение баланса на " . $request->input('amount');
        $history->save();

        return response()->json(["success"=>true,'message' => 'Balance added successfully'], 200);
    }
}
