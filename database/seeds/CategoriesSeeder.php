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
        $names = ['Tin tức', 'Hoạt động', ' Q&A'];

        foreach ($names as $name) {
            Category::create([
                'name' => $name
            ]);
        }
    }
}
