<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'holder_name',
        'bank_name',
        'account_number',
        'account_number',
        'opening_balance',
        'contact_number',
        'bank_address',
        'created_by',
    ];

    public function currency()
    {
        return $this->hasOne(BankCurrency::class , 'id' , 'currency_id');
    }
}

