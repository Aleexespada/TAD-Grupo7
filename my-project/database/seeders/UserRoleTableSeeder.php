<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/user_role.json'));
        $data = json_decode($json);

        foreach ($data as $user_role) {
            DB::table('user_role')->insert([
                'id' => $user_role->id,
                'user_id' => $user_role->user_id,
                'role_id' => $user_role->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
