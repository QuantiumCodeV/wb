<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Добавление нового поля для хранения описания заказа и удаление старого поля product_id
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('product_id'); // Удаляем старое поле product_id
            $table->json('order_description'); // Добавляем новое поле order_description для хранения описания заказа в формате JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_description'); // Удаляем новое поле order_description
            $table->integer('product_id'); // Восстанавливаем старое поле product_id
        });
    }
};
