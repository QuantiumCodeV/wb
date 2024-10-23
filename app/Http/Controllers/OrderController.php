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
        // Валідація вхідних даних
        $request->validate([
            'cart_id' => 'required|array', // Масив ідентифікаторів кошика
            'cart_num' => 'required|array' // Масив кількостей продуктів
        ]);

        $user = auth()->user();
        // Отримання останніх значень cart_id та cart_num
        $filteredCartId = array_filter($request->cart_id);
        $filteredCartNum = array_filter($request->cart_num);

        // Перевірка, чи є у нас елементи для обробки
        if (empty($filteredCartId) || empty($filteredCartNum)) {
            return response()->json(['message' => 'Немає вибраних товарів для оформлення замовлення.'], 400);
        }

        // Оновлення request з останніми значеннями
        $request->merge([
            'cart_id' => array_values($filteredCartId),
            'cart_num' => array_values($filteredCartNum)
        ]);

        // Створення масиву продуктів з даних запиту
        $products = [];
        for ($i = 0; $i < count($request->cart_id); $i++) {
            $cart = Cart::find($request->cart_id[$i]);
            $products[] = [
                'product_id' => $cart->product_id,
                'quantity' => $request->cart_num[$i],
                // Припускаємо, що у вас є метод для отримання ціни продукту за його id
                'price' => $this->getProductPrice($cart->product_id)
            ];
        }

        // Створення нового замовлення
        $order = new Order();
        $order->user_id = $user->id;
        $order->method_pay = "default";
        $order->status = "created";
        $order->order_description = $products; // Зберігаємо масив продуктів у форматі JSON
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
        $history->description = "Створення замовлення #" . $order->id;
        $history->save();

        return response()->json(['result' => true, "order_id" => $order->id], 201);
    }

    // Припускаємо, що у вас є метод для отримання ціни продукту за його id
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
            return response()->json(['result' => false, "show" => "Замовлення не знайдено"], 200);
        }
        if ($user->id != $order->user_id) {
            return response()->json(['result' => false, "show" => "Ви не можете оплатити це замовлення"], 200);
        }
        $total_price = 0;
        foreach ($order->order_description as $product) {
            $total_price += $product["price"] * $product["quantity"];
        }
        if ($user->balance < $total_price) {
            return response()->json(['result' => false, "show" => "Недостатньо коштів на балансі"], 200);
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
        $history->description = "Оплата замовлення #" . $order->id;
        $history->save();

        return response()->json(['result' => true], 200);
    }
}
