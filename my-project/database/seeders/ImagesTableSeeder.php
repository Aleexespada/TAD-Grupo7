<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/images.json'));
        $data = json_decode($json);

        foreach ($data as $image) {
            DB::table('images')->insert([
                'id' => $image->id,
                'url' => $image->url,
                'product_id' => $image->product_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
