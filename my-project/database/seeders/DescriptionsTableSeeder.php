<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/descriptions.json'));
        $data = json_decode($json);

        foreach ($data as $description) {
            DB::table('descriptions')->insert([
                'id' => $description->id,
                'product_id' => $description->product_id,
                'description' => $description->description,
                'details' => $description->details,
                'color' => $description->color,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
