<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name',
        'phone',
        'address',
        'avatar',
        'email',
        'password',
        'status'
    ];
}
