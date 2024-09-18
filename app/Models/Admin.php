<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'settings';

    protected $fillable = [
        'adminLogin',
        'adminPassword',
    ];

    protected $hidden = [
        'adminPassword',
    ];

    public function getAuthPassword()
    {
        return $this->adminPassword;
    }
}
