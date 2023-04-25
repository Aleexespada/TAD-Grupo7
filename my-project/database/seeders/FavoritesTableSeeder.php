<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/favorites.json'));
        $data = json_decode($json);

        foreach ($data as $favorite) {
            DB::table('favorites')->insert([
                'id' => $favorite->id,
                'user_id' => $favorite->user_id,
                'product_id' => $favorite->product_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
