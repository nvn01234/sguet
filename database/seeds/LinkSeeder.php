<?php

use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'url' => 'http://hong.sguet.com/',
                'description' => 'Hóng điểm thi UET tốc độ ánh sáng'
            ],
            [
                'url' => 'http://bluebee-uet.com/',
                'description' => 'Hệ thống tài liệu, đề thi các năm'
            ],
            [
                'url' => 'http://doit.uet.vnu.edu.vn/',
                'description' => 'Hệ thống hỗ trợ nâng cao chất lượng tài liệu',
            ],
            [
                'url' => 'https://112.137.129.87/',
                'description' => 'Cổng thông tin đào tạo'
            ],
            [
                'url' => 'http://student.uet.vnu.edu.vn/',
                'description' => 'Dịch vụ hỗ trợ gửi/nhận yêu cầu của Sinh viên',
            ],
            [
                'url' => 'https://drive.google.com/drive/u/0/folders/0B4Z6dhf02ykOVzlYYmtRUjNTQTg',
                'description' => 'itNoodle - App hóng điểm thi'
            ]
        ])->each(function($array) {
            \App\Models\Link::create($array);
        });
    }
}
