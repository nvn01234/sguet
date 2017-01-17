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
        $names = ['Q&A', 'Tin tức', 'Hoạt động'];

        foreach ($names as $name) {
            Category::insert([
                'name' => $name
            ]);
        }
    }
}
