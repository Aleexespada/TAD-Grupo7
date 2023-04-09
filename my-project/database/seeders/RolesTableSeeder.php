<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/roles.json'));
        $data = json_decode($json);

        foreach ($data as $rol) {
            DB::table('roles')->insert([
                'id' => $rol->id,
                'name' => $rol->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
