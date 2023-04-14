<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/order_product.json'));
        $data = json_decode($json);

        foreach ($data as $order_product) {
            DB::table('order_product')->insert([
                'id' => $order_product->id,
                'product_id' => $order_product->product_id,
                'order_id' => $order_product->order_id,
                'product_quantity' => $order_product->product_quantity,
                'product_size' => $order_product->product_size,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
