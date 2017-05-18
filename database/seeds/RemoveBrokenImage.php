<?php

use Illuminate\Database\Seeder;

class RemoveBrokenImage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::whereRaw('year(created_at) < 2017')->update([
            'image_url' => null
        ]);
    }
}
