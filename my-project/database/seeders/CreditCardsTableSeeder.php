<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreditCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/data/credit_cards.json'));
        $data = json_decode($json);

        foreach ($data as $credit_card) {
            DB::table('credit_cards')->insert([
                'id' => $credit_card->id,
                'user_id' => $credit_card->user_id,
                'card_number' => Hash::make($credit_card->card_number),
                'cardholder_name' => $credit_card->cardholder_name,
                'cvv' => Hash::make($credit_card->cvv),
                'expiration_month' => $credit_card->expiration_month,
                'expiration_year' => $credit_card->expiration_year,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
