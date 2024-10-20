<?php
namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\User;
class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "nickname" => "required|string",
            "id_product" => "required|string",
            "count_product" => "required|string",
        ]);

        $user = User::where("nickname", $request->nickname)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found.', "success"=>false]);
        }

        $cart = Cart::where("user_id", $user->id)->where("product_id", $request->id_product)->first();
        if ($cart) {
            $cart->count += $request->count_product;
        } else {
            $cart = new Cart([
                'user_id' => $user->id,
                'product_id' => $request->id_product,
                'count' => $request->count_product
            ]);
        }
        $cart->save();

        return response()->json(['message' => 'Cart added successfully.', "success"=>true]);
    }

    public function login(Request $request)
    {

        $request->validate([

            'username' => 'required|string',

            'password' => 'required|string',

        ]);


        $credentials = $request->only('username', 'password');

        $admin = Admin::where('adminLogin', $credentials['username'])->first();


        if (!$admin || !Hash::check($credentials['password'], $admin->adminPassword)) {

            throw ValidationException::withMessages([

                'username' => ['The provided credentials are incorrect.'],

            ]);

        }


        Auth::guard('admin')->login($admin);

        return response()->json(['message' => 'Login successful']);

    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        $admin = Settings::where('id', 1)->first();

        if (!Hash::check($request->old_password, $admin->adminPassword)) {
            return response()->json(['message' => 'Old password is incorrect.']);
        }

        $admin->adminPassword = Hash::make($request->new_password);

        $admin->save();

        return response()->json(['message' => 'Password changed successfully.', "success"=>true]);
    }

    public function changeLogin(Request $request)
    {
        $request->validate([
            "new_login" => "required|string",
        ]);

        $admin = Settings::where('id', 1)->first();
        $admin->adminLogin = $request->new_login;
        $admin->save();

        return response()->json(['message' => 'Login changed successfully.', "success"=>true]);
    }

    public function changeLink(Request $request)
    {
        $request->validate([
            "new_link" => "required|string",
        ]);

        $admin = Settings::where('id', 1)->first();
        $admin->linkManager = $request->new_link;
        $admin->save();

        return response()->json(['message' => 'Link changed successfully.', "success"=>true]);
    }
}


