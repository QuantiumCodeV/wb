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
        // Валидация входных данных
        $request->validate([
            'cashout_money' => 'required|numeric',
            'userbank_id' => 'required|exists:payments,id', // Проверка на существование bank_id в таблице payments
        ]);

        // Получение текущего пользователя
        $user = Auth::user();

        // Проверка баланса пользователя
        if ($user->balance < $request->cashout_money) {
            return response()->json([
                'result' => false,
                'show' => 'Недостаточно средств на счете'
            ]);
        }

        // Создание запроса на вывод средств
        Cashouts::create([
            'user_id' => $user->id,
            'amount' => $request->cashout_money,
            'status' => 'pending',
            'userbank' => $request->userbank_id
        ]);

        // Обновление баланса пользователя
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
        $history->description = "Вывод средств на карту #" . $request->id;
        $history->save();

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        Cashouts::find($request->id)->delete();

        $history = new History();
        $history->user_id = $user->id;
        $history->type = "cashout";
        $history->status = "canceled";
        $history->amount = Cashouts::find($request->id)->amount;
        $history->description = "Отмена вывода средств на карту #" . $request->id;
        $history->save();

        return response()->json(['success' => true]);
    }
}
