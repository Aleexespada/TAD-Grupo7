<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/reviews.json'));
        $data = json_decode($json);

        foreach ($data as $review) {
            DB::table('reviews')->insert([
                'id' => $review->id,
                'user_id' => $review->user_id,
                'product_id' => $review->product_id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
