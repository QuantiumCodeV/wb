<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    public function add(Request $request)
    {
        // Валидация входных данных
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

        // Создание нового адреса доставки для авторизованного пользователя
        DeliveryAddress::create([
            'name' => $request->user_name,
            'phone' => $request->user_phone,
            'address' => $request->address_text,
            'user_id' => $request->user()->id
        ]);

        // Возврат JSON ответа с результатом
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
            return response()->json(['result' => false, 'message' => 'Address not found or you do not have permission to edit this address.'], 404);
        }

        $delivery->update([
            'name' => $request->user_tname,
            'phone' => $request->user_phone,
            'address' => $request->address_text,
            'is_default' => $request->has('address_default') ? 1 : 0,
        ]);

        return response()->json(['result' => true]);
    }
    public function delete($id)
    {
        $user = auth()->user();
        $delivery = DeliveryAddress::where('user_id', $user->id)->where('id', $id)->first();

        if (!$delivery) {
            return response()->json(['result' => false, 'message' => 'Address not found or you do not have permission to delete this address.'], 404);
        }

        $delivery->delete();

        return response()->json(['result' => true]);
    }
}
