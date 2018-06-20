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
        factory(App\Models\ItemCategory::class, 5)->create();
        factory(App\Models\ItemCategory::class, 15)->create();
        factory(App\Models\Item::class, 50)->create();
        factory(App\Models\Supplier::class, 20)->create();
        factory(App\Models\Customer::class, 20)->create();
        factory(App\Models\Employee::class, 20)->create();
        factory(App\Models\ExpenseInvoice::class, 20)->create();
        factory(App\Models\Expense::class, 60)->create();
        factory(App\Models\PurchaseInvoice::class, 20)->create();
        factory(App\Models\Purchase::class, 60)->create();
        factory(App\Models\SellInvoice::class, 20)->create();
        factory(App\Models\Sell::class, 60)->create();
        factory(App\Models\UsedItemInvoice::class, 20)->create();
        factory(App\Models\UsedItem::class, 60)->create();

    }
}
