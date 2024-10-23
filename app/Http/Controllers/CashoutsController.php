<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashouts;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\History;

class CashoutsController extends Controller
{


    public function store(Request $request)
    {
        // Валідація вхідних даних
        $request->validate([
            'cashout_money' => 'required|numeric',
            'userbank_id' => 'required|exists:payments,id', // Перевірка на існування bank_id в таблиці payments
        ]);

        // Отримання поточного користувача
        $user = Auth::user();

        // Перевірка балансу користувача
        if ($user->balance < $request->cashout_money) {
            return response()->json([
                'result' => false,
                'show' => 'Недостатньо коштів на рахунку'
            ]);
        }

        // Створення запиту на виведення коштів
        Cashouts::create([
            'user_id' => $user->id,
            'amount' => $request->cashout_money,
            'status' => 'pending',
            'userbank' => $request->userbank_id
        ]);

        // Оновлення балансу користувача
        $user->balance -= $request->cashout_money;
        $user->save();

        return response()->json([
            'result' => true
        ]);
    }

    public function accept(Request $request)
    {
        Cashouts::find($request->id)->update(['status' => 'accepted']);
        User::find(Cashouts::find($request->id)->user_id)->update(['balance' => User::find(Cashouts::find($request->id)->user_id)->balance + Cashouts::find($request->id)->amount]);
        
        $history = new History();
        $history->user_id = $user->id;
        $history->type = "cashout";
        $history->status = "success";
        $history->amount = Cashouts::find($request->id)->amount;
        $history->description = "Виведення коштів на карту #" . $request->id;
        $history->save();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $cashout = Cashouts::find($request->id)->delete();
        
        $history = new History();
        $history->user_id = $cashout->user_id;
        $history->type = "cashout";
        $history->status = "canceled";
        $history->amount = Cashouts::find($request->id)->amount;
        $history->description = "Скасування виведення коштів на карту #" . $request->id;
        $history->save();

        return response()->json(['success' => true]);
    }
}
