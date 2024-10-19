<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::create([
            'holder_name' => "Mohamed",
            'bank_name' => "ABC Bank",
            'account_number' => "02131231234",
            'currency_id' => 2,
            'opening_balance' => 50,
            'contact_number' => "012213123",
            'bank_address' => "mac.st",
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        BankAccount::create([
            'holder_name' => "Mohamed",
            'bank_name' => "ABC Bank",
            'account_number' => "02131231234",
            'currency_id' => 1,
            'opening_balance' => 50,
            'contact_number' => "012213123",
            'bank_address' => "mac.st",
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        BankAccount::create([
            'holder_name' => "Mohamed",
            'bank_name' => "ABC Bank",
            'currency_id' => 3,
            'account_number' => "02131231234",
            'opening_balance' => 50,
            'contact_number' => "012213123",
            'bank_address' => "mac.st",
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BankAccount::create([
            'holder_name' => "Hassan",
            'bank_name' => "XYZ Bank",
            'account_number' => "012545632",
            'currency_id' => 1,
            'opening_balance' => 50,
            'contact_number' => "0213324",
            'bank_address' => "mac.st",
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        BankAccount::create([
            'holder_name' => "Hassan",
            'bank_name' => "XYZ Bank",
            'currency_id' => 3,
            'account_number' => "012545632",
            'opening_balance' => 50,
            'contact_number' => "0213324",
            'bank_address' => "mac.st",
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
//        BankAccount::factory()->count(10)->create();

    }
}
