<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/addresses.json'));
        $data = json_decode($json);

        foreach ($data as $address) {
            DB::table('addresses')->insert([
                'id' => $address->id,
                'user_id' => $address->user_id,
                'country' => $address->country,
                'province' => $address->province,
                'postal_code' => $address->postal_code,
                'street' => $address->street,
                'number' => $address->number,
                'floor' => $address->floor,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
