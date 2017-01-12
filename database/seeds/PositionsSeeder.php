<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Thành viên', 'Cộng tác viên'],
            ['Trưởng ban', 'Phó ban'],
            ['Coreteam'],
            ['Chủ nhiệm', 'Phó chủ nhiệm'],
            ['Founder']
        ];

        foreach ($data as $priority => $names) {
            foreach ($names as $name) {
                Position::create([
                    'name' => $name,
                    'priority' => $priority
                ]);
            }
        }
    }
}
