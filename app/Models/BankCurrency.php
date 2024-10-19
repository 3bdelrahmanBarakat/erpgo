<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCurrency extends Model
{
    protected $fillable = [
        'name',
        'symbol',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

}
