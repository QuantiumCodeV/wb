<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;


    // Связь с таблицей cashouts
    public function cashouts()
    {
        return $this->hasMany(Cashouts::class, 'userbank');
    }
}
