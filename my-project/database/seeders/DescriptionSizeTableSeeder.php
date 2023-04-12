<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DescriptionSizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/description_size.json'));
        $data = json_decode($json);

        foreach ($data as $description_size) {
            DB::table('description_size')->insert([
                'id' => $description_size->id,
                'description_id' => $description_size->description_id,
                'size_id' => $description_size->size_id,
                'stock' => $description_size->stock,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
