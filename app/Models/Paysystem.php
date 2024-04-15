<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paysystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
        'token_notification',
        'user_id',
        'name'
    ];
}