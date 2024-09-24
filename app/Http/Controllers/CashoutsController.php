<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashouts;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function updateStatus(Request $request, $id, $status)
    {
        // Проверка, чтобы новый статус был допустимым
        if (!in_array($status, ['processed', 'completed', 'rejected'])) {
            return redirect()->route('cashouts.index')->with('error', 'Invalid status provided.');
        }

        $cashout = Cashouts::findOrFail($id);
        $cashout->update(['status' => $status]);

        return redirect()->route('cashouts.index')->with('success', 'Cashout status updated successfully.');
    }
}
