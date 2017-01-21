<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PositionsSeeder::class);
        $this->call(CategoriesSeeder::class);

        // Require call before: CategoriesSeeder
        $this->call(FaqSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(ActivitiesSeeder::class);
    }
}
