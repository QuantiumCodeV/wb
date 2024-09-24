<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashouts extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'amount', 'status', 'userbank']; 

    // Связь с таблицей payments
    public function bank()
    {
        return $this->belongsTo(Payments::class, 'userbank');
    }
}
