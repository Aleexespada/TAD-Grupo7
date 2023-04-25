<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/products.json'));
        $data = json_decode($json);

        foreach ($data as $product) {
            DB::table('products')->insert([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'discount' => $product->discount,
                'brand_id' => $product->brand_id,
                'status' => $product->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
