<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserDiscountCouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/user_discount_coupon.json'));
        $data = json_decode($json);

        foreach ($data as $user_discount_coupon) {
            DB::table('user_discount_coupon')->insert([
                'id' => $user_discount_coupon->id,
                'user_id' => $user_discount_coupon->user_id,
                'discount_coupon_id' => $user_discount_coupon->discount_coupon_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
