<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountCouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/discount_coupons.json'));
        $data = json_decode($json);

        foreach ($data as $discount_coupon) {
            DB::table('discount_coupons')->insert([
                'id' => $discount_coupon->id,
                'code' => $discount_coupon->code,
                'percentage' => $discount_coupon->percentage,
                'uses_limit' => $discount_coupon->uses_limit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
