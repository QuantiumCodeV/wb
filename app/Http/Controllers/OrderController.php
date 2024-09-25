<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'cart_id' => 'required|array', // Массив идентификаторов корзины
            'cart_num' => 'required|array' // Массив количеств продуктов
        ]);

        $user = auth()->user();

        // Проверка, что cart_id и cart_num имеют одинаковое количество элементов
        if (count($request->cart_id) !== count($request->cart_num)) {
            return response()->json(['message' => 'Неправильное количество элементов в массивах cart_id и cart_num.'], 400);
        }

        // Создание массива продуктов из данных запроса
        $products = [];
        for ($i = 0; $i < count($request->cart_id); $i++) {
            $products[] = [
                'product_id' => $request->cart_id[$i],
                'quantity' => $request->cart_num[$i],
                // Предполагаем, что у вас есть метод для получения цены продукта по его id
                'price' => $this->getProductPrice($request->cart_id[$i])
            ];
        }

        // Создание нового заказа
        $order = new Order();
        $order->user_id = $user->id;
        $order->method_pay = "default";
        $order->status = "created";
        $order->order_description = $products; // Сохраняем массив продуктов в формате JSON
        $order->save();

        return response()->json(['result' => true, "order_id"=>$order->id], 201);
    }

    // Предполагаем, что у вас есть метод для получения цены продукта по его id
    private function getProductPrice($productId)
    {
        $product = \App\Models\Product::find($productId);
        return $product ? $product->price : 0;
    }


    public function pay(Request $request){
        $order = Order::find($request->order_id);
        $order->status = "payed";
        $order->save();
    }
}
