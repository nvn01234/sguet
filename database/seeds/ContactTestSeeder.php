<?php

use Illuminate\Database\Seeder;

class ContactTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Contact::class, 5)->create();
        factory(\App\Contact::class, 10)->create();
        factory(\App\Contact::class, 20)->create();
    }
}
