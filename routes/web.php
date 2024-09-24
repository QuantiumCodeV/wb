<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\DeliveryAddress;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    // Загружаем категории вместе с их продуктами

    $categories = Category::with('products')->get();

    return view('index', ['categories' => $categories]);
})->name('index');



/* ====================================================
            ADMIN PANEL
 ==================================================== */
Route::prefix("admin")->group(function () {

    Route::get('/login', function () {
        return view('admin.login');
    })->name("admin.login");

    Route::post("/login", [App\Http\Controllers\AdminController::class, "login"])->name("admin.api.login");


    Route::middleware('auth.admin')->group(function () {

        Route::get("/logout", [App\Http\Controllers\AdminController::class, "logout"])->name("admin.logout");
        Route::post("/change_password", [App\Http\Controllers\AdminController::class, "change_password"])->name("admin.api.change_password");


        Route::get("/", function () {
            return view("admin.index");
        })->name("admin.index");

        Route::get("/settings", function () {
            return view("admin.settings");
        })->name("admin.settings");

        Route::group(["prefix" => "products"], function () {
            Route::get("/", function () {
                return view("admin.products", [
                    "products" => App\Models\Product::all(),
                    "categories" => App\Models\Category::all()
                ]);
            })->name("admin.products");

            Route::post("/add", [ProductController::class, "store"])->name("admin.products.store");
            Route::put("/{product}", [ProductController::class, "update"])->name("admin.products.update");
            Route::delete("/{product}", [ProductController::class, "delete"])->name("admin.products.delete");
        });

        Route::group(["prefix" => "categories"], function () {
            Route::get("/", function () {
                return view("admin.categories", [
                    "categories" => App\Models\Category::all()
                ]);
            })->name("admin.categories");

            Route::post("/add", [App\Http\Controllers\CategoryController::class, "store"])->name("admin.categories.add");
            Route::put("/{category}", [App\Http\Controllers\CategoryController::class, "update"])->name("admin.categories.update");
            Route::delete("/{category}", [App\Http\Controllers\CategoryController::class, "delete"])->name("admin.categories.delete");
        });



        Route::group(["prefix" => "settings"], function () {

            Route::get("/", function () {
                return view("admin.settings", [
                    "settings" => App\Models\Settings::first()
                ]);
            })->name("admin.settings");

            Route::post("/change_password", [App\Http\Controllers\AdminController::class, "changePassword"])->name("admin.api.change_password");

            Route::post("/change_login", [App\Http\Controllers\AdminController::class, "changeLogin"])->name("admin.api.change_login");

            Route::post("/change_link", [App\Http\Controllers\AdminController::class, "changeLink"])->name("admin.api.change_link");
        });
    });
});


/* ====================================================
            END ADMIN PANEL
 ==================================================== */



/* ====================================================
                USER
====================================================*/
Route::prefix("user")->group(function () {
    Route::post("/register", [App\Http\Controllers\UserController::class, "register"])->name("user.api.register");
    Route::post("/login", [App\Http\Controllers\UserController::class, "login"])->name("user.api.login");
});


Route::get("/login", function () {
    return view("auth.login");
})->name("auth.login");

Route::get("/register", function () {
    return view("auth.register");
})->name("auth.register");



Route::middleware(['auth'])->group(function () {
    Route::get("/logout", [App\Http\Controllers\UserController::class, "logout"])->name("auth.logout");

    Route::get('/cart', function () {
        return view('profile.cart');
    })->name("cart");

    Route::get("/cart/add/{product}/{count}", [App\Http\Controllers\CartController::class, "add"])->name("cart.add");

    Route::get("/profile", function () {
        return view("profile.profile", [
            "user" => Auth::user(),
            "settings" => App\Models\Settings::first()
        ]);
    })->name("profile");

    Route::get("/profile/change_password", function () {
        return view("profile.change_password");
    })->name("profile.change_password");

    Route::post("/profile/change_password", [App\Http\Controllers\UserController::class, "changePassword"])->name("user.api.change_password");

    Route::get("/order", function () {
        return view("profile.order");
    })->name("order");

    Route::get('/favorites', function () {

        $user = Auth::user();

        return view('profile.favorites')

            ->with('user', $user)

            ->with('favorites', $user->favoriteProducts);
    })->name('favorites');

    Route::get("/search", function () {
        return view("search");
    })->name("search");

    Route::get("/history", function () {
        return view("profile.history");
    })->name("history");



    Route::group(["prefix" => "product"], function () {
        Route::get("/{product}", function ($id) {
            return view("product", [
                "product" => App\Models\Product::find($id)
            ]);
        })->name("product");

        Route::post("/{product}/favorite", [App\Http\Controllers\ProductController::class, "addToFavorites"])->name("product.favorite.add");
        Route::get("/{product}/favorite/delete", [App\Http\Controllers\ProductController::class, "removeFromFavorites"])->name("product.favorite.delete");
    });


    Route::get("/settings", function () {
        return view("profile.settings");
    })->name("settings");


    Route::get("/history", function () {
        return view("profile.history");
    })->name("history");


    Route::get("/deposit", function () {
        return view("profile.deposit", [
            "settings" => App\Models\Settings::first()
        ]);
    })->name("deposit");



    Route::get("/cashout", function () {
        return view("profile.cashout", [
            "payments" => App\Models\Payments::where("user_id", Auth::user()->id)->get()
        ]);
    })->name("cashout");


    Route::get("/payment/methods", function () {
        return view("payment.payment_methods", [
            "methods" => App\Models\Payments::where("user_id", Auth::user()->id)->get()
        ]);
    })->name("payment.methods");

    Route::get("/payment/add", function () {
        return view("payment.payment_add");
    })->name("payment.add");

    Route::get("/payment/delete/{method}", [App\Http\Controllers\PaymentController::class, "delete"])->name("api.payment.delete");

    Route::post("/payment/add", [App\Http\Controllers\PaymentController::class, "add"])->name("api.payments.add");

    Route::get('/delivery', function () {
        // Проверка авторизации
        if (!auth()->check()) {
            return redirect('/login'); // или другой маршрут, если пользователь не авторизован
        }

        // Получение данных только для авторизованного пользователя
        $user = auth()->user();
        $deliveryPoints = DeliveryAddress::where('user_id', $user->id)->get();
        return view('delivery.delivery', compact('deliveryPoints'));
    })->name('delivery')->middleware('auth'); // Middleware auth для проверки авторизации

    //deliveryAdd

    Route::get("/delivery/add", function () {
        return view('delivery.delivery_add');
    })->name("delivery.add")->middleware('auth');

    Route::post("/api/delivery/add", [DeliveryController::class, "add"])->name("api.delivery.add");

    Route::get('/delivery/edit/{id}', function ($id) {
        $user = auth()->user();
        $delivery = DeliveryAddress::where('user_id', $user->id)->where('id', $id)->first();

        if (!$delivery) {
            return redirect()->route('delivery')->with('error', 'Address not found or you do not have permission to edit this address.');
        }

        return view('delivery.delivery_edit', compact('delivery'));
    })->name('user.address.edit')->middleware('auth');
    Route::post('/api/delivery/update/{id}', [DeliveryController::class, 'update'])->name('api.delivery.update')->middleware('auth');
    

    Route::get('/api/delivery/delete/{id}', [DeliveryController::class, 'delete'])->name('user.address.delete')->middleware('auth');

    Route::get("/about_us", function () {
        return view("about_us");
    })->name("about_us");
});

/* ====================================================
            END USER
 ==================================================== */
