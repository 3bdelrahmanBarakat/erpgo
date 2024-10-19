<?php

namespace App\Http\Mapper;

use Illuminate\Database\Eloquent\Collection;

class BankMapper
{

    public static function map($bankAccount): array|object
    {
        if ($bankAccount instanceof Collection) {
            return $bankAccount->map(function ($item) {
                return self::mapBankAccount($item);
            })->toArray();
        } else {
            return self::mapBankAccount($bankAccount);
        }
    }

    private static function mapBankAccount($bankAccount): object
    {
        return (object)[
            'id' => $bankAccount->id,
            'holder_name' => $bankAccount->holder_name,
            'bank_name' => $bankAccount->bank_name,
            'account_number' => $bankAccount->account_number,
            'opening_balance' => $bankAccount->opening_balance,
            'contact_number' => $bankAccount->contact_number,
            'bank_address' => $bankAccount->bank_address,
            'created_by' => $bankAccount->created_by,
            'created_at' => $bankAccount->created_at,
            'currency' => self::mapCurrency($bankAccount),
        ];
    }

    public static function mapCurrency($bankAccount)
    {
        return optional($bankAccount->currency)->name;
    }

}
