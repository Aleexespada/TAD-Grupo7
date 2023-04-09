<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/brands.json'));
        $data = json_decode($json);

        foreach ($data as $brand) {
            DB::table('brands')->insert([
                'id' => $brand->id,
                'name' => $brand->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
