<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // $faker = Faker::create();

        // Giả sử bạn đã có dữ liệu category với id từ 1 đến 10
        // $categories = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        // for ($i = 0; $i < 50; $i++) {
        //     $name = $faker->unique()->randomElement([
        //         'iPhone 14', 'Samsung Galaxy S23', 'Xiaomi Mi 11', 'Huawei P50', 'Oppo Find X3',
        //         'Vivo X60', 'OnePlus 9', 'Sony Xperia 1', 'Nokia 8.3', 'Google Pixel 6'
        //     ]);

        //     Product::create([
        //         'name' => $name,
        //         'price' => $faker->randomFloat(2, 300, 1500), // Giá từ 300 đến 1500
        //         'discount' => $faker->numberBetween(0, 30), // Discount từ 0 đến 30%
        //         'category_id' => $faker->randomElement($categories), // Chọn ngẫu nhiên category_id
        //         'description' => $faker->sentence(15), // Mô tả ngẫu nhiên với 15 từ
        //         'tag' => $faker->word(), // Tag ngẫu nhiên
        //         'slug' => Str::slug($name), // Tạo slug từ tên sản phẩm
        //         'img' => $faker->imageUrl(640, 480, 'technics', true, 'phones') // URL hình ảnh ngẫu nhiên về điện thoại
        //     ]);
        // }
        //     Product::insert(
        //         [
        //                     'name' => '',
        //                     'price' => '',
        //                     'discount' => '',
        //                     'category_id' => '',
        //                     'description' => '',
        //                     'tag' => '',
        //                     'slug' => Str::slug(''),
        //                     'img' => '',
        //                 ],

        // );
    }
}
