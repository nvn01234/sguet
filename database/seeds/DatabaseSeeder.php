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
        $this->call(ScaffoldInterfacesSeeder::class);
        $this->call(PositionsSeeder::class);
        $this->call(CategoriesSeeder::class);
    }
}
