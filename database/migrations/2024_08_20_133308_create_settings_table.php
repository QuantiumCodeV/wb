<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("linkManager");
            $table->string("adminLogin");
            $table->string("adminPassword");
            $table->timestamps();
        });

        DB::table('settings')->insert([

            'linkManager' => 'defaultLinkManager',

            'adminLogin' => 'defaultAdmin',

            'adminPassword' => Hash::make('defaultPassword'), // используем bcrypt для хеширования пароля

            'created_at' => now(),

            'updated_at' => now(),

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
