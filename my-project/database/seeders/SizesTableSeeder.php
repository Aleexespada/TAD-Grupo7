<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/sizes.json'));
        $data = json_decode($json);

        foreach ($data as $size) {
            DB::table('sizes')->insert([
                'id' => $size->id,
                'size' => $size->size,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
