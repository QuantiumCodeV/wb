<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [

        'images' => 'array',

        'dopInfo' => 'array',

    ];


    protected $fillable = [

        'name',
        'price',
        'images',
        'sales',
        'description',
        'category_id',
        'dopInfo'

    ];

    public function favoritedByUsers()
    {

        return $this->belongsToMany(User::class, 'favorites');

    }
    public function category()
    {

        return $this->belongsTo(Category::class);



    }
}
