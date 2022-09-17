<?php

namespace Database\Seeders;

use App\Modules\SubCategory\Models\SubCategory;
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
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(InnerCategorySeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
