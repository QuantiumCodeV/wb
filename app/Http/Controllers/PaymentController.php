<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;

class PaymentController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'card' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'userbank_type' => 'required',
        ]);

        $payment = new Payments();
        $payment->card = $request->card;
        $payment->user_id = $request->user_id;
        $payment->name = $request->name;
        $payment->bank = $request->userbank_type;
        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Спосіб оплати успішно додано',
        ]);
    }

    public function delete($method)
    {
        $payment = Payments::findOrFail($method);
        $payment->delete();
        return response()->json([
            'success' => true,
            'message' => 'Спосіб оплати успішно видалено',
        ]);
    }
}
