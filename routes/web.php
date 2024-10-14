<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CashoutsController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\DeliveryAddress;
use App\Http\Controllers\OrderController;
use App\Models\Order;

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

/* ====================================================
            MAIN ROUTES
 ==================================================== */

// Главная страница
Route::get('/', function () {
    // Загружаем категории вместе с их продуктами
    $categories = Category::with('products')->get();
    return view('index', ['categories' => $categories]);
})->name('index');

/* ====================================================
            ADMIN PANEL
 ==================================================== */

Route::prefix("admin")->group(function () {

    // Страницы авторизации администратора
    Route::get('/login', function () {
        return view('admin.login');
    })->name("admin.login");

    Route::post("/login", [App\Http\Controllers\AdminController::class, "login"])->name("admin.api.login");

    Route::middleware('auth.admin')->group(function () {

        // Логаут администратора
        Route::get("/logout", [App\Http\Controllers\AdminController::class, "logout"])->name("admin.logout");

        // Изменение пароля администратора
        Route::post("/change_password", [App\Http\Controllers\AdminController::class, "change_password"])->name("admin.api.change_password");

        // Главная страница и настройки панели администратора
        Route::get("/", function () {
            return view("admin.index");
        })->name("admin.index");

        // Обработка запросов на вывод средств
        Route::get("/cashouts", function () {
            return view("admin.cashouts", [
                "cashouts" => App\Models\Cashouts::orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")->get()
            ]);
        })->name("admin.cashouts");

        // Страница настроек администратора
        Route::get("/settings", function () {
            return view("admin.settings");
        })->name("admin.settings");

        Route::get("/deposit", function () {
            return view("admin.deposit");
        })->name("admin.deposit");
        Route::post("/deposit", [UserController::class, "addBalance"])->name("admin.api.deposit");

        Route::post("/cashouts/accept", [CashoutsController::class, "accept"])->name("admin.cashouts.accept");
        Route::post("/cashouts/delete", [CashoutsController::class, "delete"])->name("admin.cashouts.delete");

        // Управление продуктами в админке
        Route::group(["prefix" => "products"], function () {
            Route::get("/", function () {
                return view("admin.products", [
                    "products" => App\Models\Product::all(),
                    "categories" => App\Models\Category::all()
                ]);
            })->name("admin.products");

            Route::post("/delete", [ProductController::class, "delete"])->name("admin.products.delete");

            Route::post("/add", [ProductController::class, "store"])->name("admin.products.store");
            Route::put("/{product}", [ProductController::class, "update"])->name("admin.products.update");
            
        });

        // Управление категориями в админке
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

        // Дополнительные настройки админ панели
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
 ==================================================== */

// Регистрация и авторизация пользователя
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

// Маршруты для авторизированных пользователей
Route::middleware(['auth'])->group(function () {
    Route::post("/api/order/pay", [OrderController::class, "pay"])->name("api.order.pay");
    // Логаут пользователя
    Route::get("/logout", [App\Http\Controllers\UserController::class, "logout"])->name("auth.logout");

    // Корзина
    Route::get('/cart', function () {
        $cartItems = App\Models\Cart::where("user_id", auth()->user()->id)->get();
        return view('profile.cart', [
            "cartItems" => $cartItems
        ]);
    })->name("cart");

    Route::get("/cart/editCount/{id}/{num}", [App\Http\Controllers\CartController::class, "editCount"])->name("cart.editCount");

    Route::get("/cart/add/{product}/{count}", [App\Http\Controllers\CartController::class, "add"])->name("cart.add");

    // Профиль пользователя
    Route::get("/profile", function () {
        return view("profile.profile", [
            "user" => auth()->user(),
            "settings" => App\Models\Settings::first()
        ]);
    })->name("profile");

    Route::get("/profile/change_password", function () {
        return view("profile.change_password");
    })->name("profile.change_password");

    Route::post("/profile/change_password", [App\Http\Controllers\UserController::class, "changePassword"])->name("user.api.change_password");

    // Заказы пользователя
    Route::get("/order", function () {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return view("profile.order", ['orders' => $orders]);
    })->name("order");

    Route::get("/order/submit/{order_id}", function ($order_id) {
        // Поиск заказа по его идентификатору
        $order = Order::find($order_id);

        // Проверка, найден ли заказ
        if (!$order) {
            // Обработка ошибки, если заказ не найден
            return redirect()->route('profile');
        }

        // Возвращаем представление с данными заказа
        return view("profile.submit_order", compact('order'));
    })->name("submit_order");


    Route::get("/order/success/{order_id}", function ($order_id) {
        $order = Order::findOrFail($order_id);
        return view("profile.success_order", compact('order'));
    })->name("success_order");

    Route::post("/order/store", [OrderController::class, "store"])->name("order.store");

    // Избранное
    Route::get('/favorites', function () {
        $user = auth()->user();
        return view('profile.favorites', [
            'user' => $user,
            'favorites' => $user->favoriteProducts
        ]);
    })->name('favorites');

    // Поиск
    Route::get("/search", function () {
        return view("search");
    })->name("search");

    // История заказов
    Route::get("/history", function () {
        $histories = App\Models\History::where("user_id", auth()->user()->id)->get();
        return view("profile.history", [
            "histories" => $histories
        ]);
    })->name("history");

    // Упраление продуктами пользователя
    Route::group(["prefix" => "product"], function () {
        Route::get("/{product}", function ($id) {
            return view("product", [
                "product" => App\Models\Product::find($id)
            ]);
        })->name("product");

        Route::post("/{product}/favorite", [App\Http\Controllers\ProductController::class, "addToFavorites"])->name("product.favorite.add");
        Route::get("/{product}/favorite/delete", [App\Http\Controllers\ProductController::class, "removeFromFavorites"])->name("product.favorite.delete");
    });

    // Настройки профиля
    Route::get("/settings", function () {
        return view("profile.settings");
    })->name("settings");

    

    // Пополнение счета
    Route::get("/deposit", function () {
        return view("profile.deposit", [
            "settings" => App\Models\Settings::first()
        ]);
    })->name("deposit");

    // Запрос на вывод средств пользователя
    Route::get("/cashout", function () {
        return view("profile.cashout", [
            "payments" => App\Models\Payments::where("user_id", auth()->user()->id)->get()
        ]);
    })->name("cashout");

    // Методы оплаты
    Route::get("/payment/methods", function () {
        return view("payment.payment_methods", [
            "methods" => App\Models\Payments::where("user_id", auth()->user()->id)->get()
        ]);
    })->name("payment.methods");

    Route::get("/payment/add", function () {
        return view("payment.payment_add");
    })->name("payment.add");

    Route::get("/payment/delete/{method}", [App\Http\Controllers\PaymentController::class, "delete"])->name("api.payment.delete");
    Route::post("/payment/add", [App\Http\Controllers\PaymentController::class, "add"])->name("api.payments.add");

    // Адреса доставки
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

    // Добавление адреса доставки
    Route::get("/delivery/add", function () {
        return view('delivery.delivery_add');
    })->name("delivery.add")->middleware('auth');

    Route::post("/api/delivery/add", [DeliveryController::class, "add"])->name("api.delivery.add");

    // Редактирование адреса доставки
    Route::get('/delivery/edit/{id}', function ($id) {
        $user = auth()->user();
        $delivery = DeliveryAddress::where('user_id', $user->id)->where('id', $id)->first();

        if (!$delivery) {
            return redirect()->route('delivery')->with('error', 'Address not found or you do not have permission to edit this address.');
        }

        return view('delivery.delivery_edit', compact('delivery'));
    })->name('user.address.edit')->middleware('auth');

    Route::post('/api/delivery/update/{id}', [DeliveryController::class, 'update'])->name('api.delivery.update')->middleware('auth');

    // Удаление адреса доставки
    Route::get('/api/delivery/delete/{id}', [DeliveryController::class, 'delete'])->name('user.address.delete')->middleware('auth');

    // О нас
    Route::get("/about_us", function () {
        return view("about_us");
    })->name("about_us");

    // Добавление запроса на вывод средств
    Route::post('/cashouts', [CashoutsController::class, 'store'])->name('cashouts.store')->middleware('auth');
});
/* ====================================================
            END USER
 ==================================================== */
