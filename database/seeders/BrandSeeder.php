<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::truncate();

        Brand::create([
            'name' => 'Samsung'
        ]);

        Brand::create([
            'name' => 'OnePlus'
        ]);

        Brand::create([
            'name' => 'Xiaomi'
        ]);

        Brand::create([
            'name' => 'Oppo'
        ]);

        Brand::create([
            'name' => 'Vivo'
        ]);
    }
}
