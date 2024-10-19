<?php

namespace Database\Seeders;

use App\Models\BankCurrency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankCurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankCurrency::create([
            "name" => "USD",
            "symbol" => "$"
        ]);

        BankCurrency::create([
            "name" => "EGP",
            "symbol" => "L.E"

        ]);

        BankCurrency::create([
            "name" => "AED",
            "symbol" => "AED"
        ]);
    }
}
