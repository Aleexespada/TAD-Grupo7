<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/users.json'));
        $data = json_decode($json);

        foreach ($data as $user) {
            DB::table('users')->insert([
                'id' => $user->id,
                'name' => $user->name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'password' => Hash::make($user->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
