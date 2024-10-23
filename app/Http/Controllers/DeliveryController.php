<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Validator;
use App\Models\History;

class DeliveryController extends Controller
{
    public function add(Request $request)
    {
        // Валідація вхідних даних
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'address_text' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Створення нової адреси доставки для авторизованого користувача
        DeliveryAddress::create([
            'name' => $request->user_name,
            'phone' => $request->user_phone,
            'address' => $request->address_text,
            'user_id' => $request->user()->id
        ]);


        $history = new History();
        $history->user_id = $request->user()->id;
        $history->type = "delivery";
        $history->status = "success";
        $history->amount = 0;
        $history->description = "Додавання адреси доставки";
        $history->save();

        // Повернення JSON відповіді з результатом
        return response()->json(['result' => true]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_tname' => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'address_text' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'result' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = auth()->user();
        $delivery = DeliveryAddress::where('user_id', $user->id)->where('id', $id)->first();

        if (!$delivery) {
            return response()->json(['result' => false, 'message' => 'Адресу не знайдено або у вас немає дозволу на редагування цієї адреси.'], 404);
        }

        $delivery->update([
            'name' => $request->user_tname,
            'phone' => $request->user_phone,
            'address' => $request->address_text,
            'is_default' => $request->has('address_default') ? 1 : 0,
        ]);

        $history = new History();
        $history->user_id = $user->id;
        $history->type = "delivery";
        $history->status = "success";
        $history->amount = 0;
        $history->description = "Зміна адреси доставки";
        $history->save();

        return response()->json(['result' => true]);
    }
    public function delete($id)
    {
        $user = auth()->user();
        $delivery = DeliveryAddress::where('user_id', $user->id)->where('id', $id)->first();

        if (!$delivery) {
            return response()->json(['result' => false, 'message' => 'Адресу не знайдено або у вас немає дозволу на видалення цієї адреси.'], 404);
        }

        $delivery->delete();

        $history = new History();
        $history->user_id = $user->id;
        $history->type = "delivery";
        $history->status = "success";
        $history->amount = 0;
        $history->description = "Видалення адреси доставки";
        $history->save();

        return response()->json(['result' => true]);
    }
}
