<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/categories.json'));
        $data = json_decode($json);

        foreach ($data as $category) {
            DB::table('categories')->insert([
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
