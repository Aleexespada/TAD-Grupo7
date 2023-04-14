<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/orders.json'));
        $data = json_decode($json);

        foreach ($data as $order) {
            DB::table('orders')->insert([
                'id' => $order->id,
                'user_id' => $order->user_id,
                'address_id' => $order->address_id,
                'credit_card_id' => $order->credit_card_id,
                'status' => $order->status,
                'total_price' => $order->total_price,
                'order_date' => now(),
                'comments' => $order->comments,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
