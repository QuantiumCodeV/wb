<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add($product, $count)
    {
        $user = Auth::user();
        $cart = Cart::where("user_id", $user->id)->where("product_id", $product)->first();
        if ($cart) {
            $cart->count = $cart->count + $count;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->product_id = $product;
            $cart->count = $count;
            $cart->save();
        }
        return response()->json([
            "result" => true,
            "cart_num" => Cart::where("user_id", $user->id)->count()
        ]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $product_id = $request->input("product_id");
        $cart = Cart::where("user_id", $user->id)->where("product_id", $product_id)->first();
        if ($cart) {
            $cart->delete();
        }
        return redirect()->back();
    }
}
