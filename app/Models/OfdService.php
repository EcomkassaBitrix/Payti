<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfdService extends Model
{
    use HasFactory;

    protected $fillable = [
        'login',
        'password',
        'shop_id',
        'user_id',
        'name',
        'token',
        'company_email',
        'company_sno',
        'company_inn',
        'company_payment_address',
        'client_email',
        'payment_method',
        'payment_object',
        'vat'
    ];
}
