<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [Category::NAME_FAQ, Category::NAME_NEWS, Category::NAME_ACTIVITIES];

        foreach ($names as $name) {
            Category::insert([
                'name' => $name
            ]);
        }
    }
}
