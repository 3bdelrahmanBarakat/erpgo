<?php

namespace Database\Seeders;

use App\Models\ProductServiceUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductServiceUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductServiceUnit::create(
            [
                'name' => 'GM',
                'created_by' => 2
            ]
        );
        ProductServiceUnit::create(
            [
                'name' => 'KG',
                'created_by' => 2
            ]
        );
        ProductServiceUnit::create(
            [
                'name' => 'Pound',
                'created_by' => 2
            ]
        );
    }
}
