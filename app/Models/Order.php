<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_description', 'method_pay', 'status'];

    protected $casts = [
        'order_description' => 'array', // Автоматическое преобразование JSON-строки в массив и обратно
    ];
}
