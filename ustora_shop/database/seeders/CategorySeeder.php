<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Apple',
            'Samsung',
            'Xiaomi',
            'Huawei',
            'Oppo',
            'Vivo',
            'Sony',
            'Nokia',
            'Google'
        ];

        foreach ($categories as $category) {
            Categories::create([
                'name' => $category,
            ]);
        }
    }
}
