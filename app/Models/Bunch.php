<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunch extends Model
{
    use HasFactory;

    protected $fillable = [
        'paysystem_id',
        'ofd_service_id',
        'user_id'
    ];
}
