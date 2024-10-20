<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\History;
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
        // Получение последних значений cart_id и cart_num
        $filteredCartId = array_filter($request->cart_id);
        $filteredCartNum = array_filter($request->cart_num);

        // Проверка, что у нас есть элементы для обработки
        if (empty($filteredCartId) || empty($filteredCartNum)) {
            return response()->json(['message' => 'Нет выбранных товаров для оформления заказа.'], 400);
        }

        // Обновление request с последними значениями
        $request->merge([
            'cart_id' => array_values($filteredCartId),
            'cart_num' => array_values($filteredCartNum)
        ]);

        // Создание массива продуктов из данных запроса
        $products = [];
        for ($i = 0; $i < count($request->cart_id); $i++) {
            $cart = Cart::find($request->cart_id[$i]);
            $products[] = [
                'product_id' => $cart->product_id,
                'quantity' => $request->cart_num[$i],
                // Предполагаем, что у вас есть метод для получения цены продукта по его id
                'price' => $this->getProductPrice($cart->product_id)
            ];
        }

        // Создание нового заказа
        $order = new Order();
        $order->user_id = $user->id;
        $order->method_pay = "default";
        $order->status = "created";
        $order->order_description = $products; // Сохраняем массив продуктов в формате JSON
        $order->save();

        $total_price = 0;
        foreach ($order->order_description as $product) {
            $total_price += $product["price"] * $product["quantity"];
        }


        $history = new History();
        $history->user_id = $user->id;
        $history->type = "order";
        $history->status = "success";
        $history->amount = $total_price;
        $history->description = "Создание заказа #" . $order->id;
        $history->save();

        return response()->json(['result' => true, "order_id" => $order->id], 201);
    }

    // Предполагаем, что у вас есть метод для получения цены продукта по его id
    private function getProductPrice($productId)
    {
        $product = \App\Models\Product::find($productId);
        return $product ? $product->price : 0;
    }


    public function pay(Request $request)
    {

        $user = auth()->user();
        if (!$user) {
            return redirect()->route("auth.login");
        }


        $order = Order::find($request->order_id);
        if (!$order) {
            return response()->json(['result' => false, "show" => "Заказ не найден"], 200);
        }
        if ($user->id != $order->user_id) {
            return response()->json(['result' => false, "show" => "Вы не можете оплатить этот заказ"], 200);
        }
        $total_price = 0;
        foreach ($order->order_description as $product) {
            $total_price += $product["price"] * $product["quantity"];
        }
        if ($user->balance < $total_price) {
            return response()->json(['result' => false, "show" => "Недостаточно средств на балансе"], 200);
        }
        $user->balance -= $total_price;
        $user->save();

        $order->status = "payed";
        $order->save();

        $history = new History();
        $history->user_id = $user->id;
        $history->type = "order";
        $history->status = "success";
        $history->amount = $total_price;
        $history->description = "Оплата заказа #" . $order->id;
        $history->save();

        return response()->json(['result' => true], 200);
    }
}
