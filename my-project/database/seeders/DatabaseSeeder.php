<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AddressesTableSeeder::class,
            CreditCardsTableSeeder::class,
            RolesTableSeeder::class,
            UserRoleTableSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ProductsTableSeeder::class,
            CategoryProductTableSeeder::class,
            DescriptionsTableSeeder::class,
            ImagesTableSeeder::class,
            SizesTableSeeder::class,
            DescriptionSizeTableSeeder::class,
            CartItemsTableSeeder::class,
            DiscountCouponsTableSeeder::class,
            UserDiscountCouponTableSeeder::class,
            OrdersTableSeeder::class,
            OrderProductTableSeeder::class,
            ReviewsTableSeeder::class,
            FavoritesTableSeeder::class
        ]);
    }
}
