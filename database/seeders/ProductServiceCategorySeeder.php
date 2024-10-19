<?php

namespace Database\Seeders;

use App\Models\ProductServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductServiceCategory::factory()->count(50)->create(); // Creates 50 fake customers

    }
}
