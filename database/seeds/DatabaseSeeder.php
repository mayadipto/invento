<?php

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
        factory(App\User::class, 5)->create();
        factory(App\Models\Brand::class, 10)->create();
        factory(App\Models\ExpenseCategory::class, 5)->create();
        factory(App\Models\ExpenseCategory::class, 15)->create();
        factory(App\Models\ExpenseItem::class, 50)->create();
        factory(App\Models\ItemCategory::class, 5)->create();
        factory(App\Models\ItemCategory::class, 15)->create();
        factory(App\Models\Item::class, 50)->create();
        factory(App\Models\Supplier::class, 10)->create();

    }
}
