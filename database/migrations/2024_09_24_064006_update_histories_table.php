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
        // Создание временной таблицы с новыми полями
        Schema::create('histories_temp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->string('type');
            $table->string('description')->default('');
            $table->decimal('amount', 8, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Перенос данных из старой таблицы в новую
        \DB::statement('INSERT INTO histories_temp (id, user_id, status, type, amount, created_at, updated_at) SELECT id, user_id, status, type, price as amount, created_at, updated_at FROM histories');

        // Удаление старой таблицы
        Schema::dropIfExists('histories');

        // Переименование новой таблицы в оригинальное имя
        Schema::rename('histories_temp', 'histories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Создание временной таблицы для отката данных
        Schema::create('histories_temp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            $table->string('type');
            $table->integer('product_id')->nullable();
            $table->string('price');
            $table->timestamps();
        });

        // Перенос данных обратно из текущей таблицы в временную
        \DB::statement('INSERT INTO histories_temp (id, user_id, status, type, price, created_at, updated_at) SELECT id, user_id, status, type, amount as price, created_at, updated_at FROM histories');

        // Удаление текущей таблицы
        Schema::dropIfExists('histories');

        // Переименование временной таблицы обратно в оригинальное имя
        Schema::rename('histories_temp', 'histories');
    }
};
