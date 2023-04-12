<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/category_product.json'));
        $data = json_decode($json);

        foreach ($data as $category_product) {
            DB::table('category_product')->insert([
                'id' => $category_product->id,
                'product_id' => $category_product->product_id,
                'category_id' => $category_product->category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
