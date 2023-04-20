<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW top_products AS
            SELECT p.name, COUNT(op.product_id) as num_orders, MIN(i.url) as image_url
            FROM products p
            JOIN order_product op ON p.id = op.product_id
            LEFT JOIN (
                SELECT product_id, MIN(url) as url
                FROM images
                GROUP BY product_id
            ) i ON p.id = i.product_id
            GROUP BY p.id
            ORDER BY num_orders DESC
            LIMIT 5;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS top_products');
    }
};
