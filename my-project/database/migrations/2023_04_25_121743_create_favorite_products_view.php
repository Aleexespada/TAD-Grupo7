<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW favorite_products AS
            SELECT products.*, COUNT(favorites.product_id) as favorite_count
            FROM products
            JOIN favorites ON products.id = favorites.product_id
            GROUP BY products.id
            ORDER BY COUNT(favorites.product_id) DESC
            LIMIT 5
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS favorite_products;');
    }
};
