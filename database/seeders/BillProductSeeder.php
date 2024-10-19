<?php

namespace Database\Seeders;

use App\Models\BillProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BillProduct::factory()->count(100)->create();
    }
}
