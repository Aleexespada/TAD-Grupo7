<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/cart_items.json'));
        $data = json_decode($json);

        foreach ($data as $cart_item) {
            DB::table('cart_items')->insert([
                'id' => $cart_item->id,
                'user_id' => $cart_item->user_id,
                'product_id' => $cart_item->product_id,
                'quantity' => $cart_item->quantity,
                'size' => $cart_item->size,
                'unity_price' => $cart_item->unity_price,
                'subtotal' => $cart_item->subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
