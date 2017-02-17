<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use App\Team;
use App\Member;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $excel = App::make('excel');
        $excel->load(database_path('data/DSSG.xlsx'), function ($reader) {
            /**
             * @var LaravelExcelReader $reader
             */
            $collection = $reader->all();
            if ($collection instanceof SheetCollection) {
                /**
                 * @var SheetCollection $collection
                 */
                foreach ($collection->all() as $sheet) {
                    $this->readSheet($sheet);
                }
            } else if ($collection instanceof RowCollection) {
                $this->readSheet($collection);
            }
        });
    }

    /**
     * @param RowCollection $sheet
     */
    function readSheet($sheet)
    {
        $sheet_title = $sheet->getTitle();
        $sheet_title_parts = explode(' ', $sheet_title, 2);

        /**
         * @var \App\Team $team
         */
        $team = Team::create([
            'name' => $sheet_title_parts[0],
            'year' => $sheet_title_parts[1],
        ]);

        foreach ($sheet->all() as $row) {
            /**
             * @var CellCollection $row
             * @var \App\Member $member
             */
            if ($row->get('ho_va_ten')) {
                Member::create([
                    'name' => $row->get('ho_va_ten'),
                    'birthday' => $row->get('ngay_sinh'),
                    'class' => $row->get('lop'),
                    'gender' => $row->get('nu') === "x" ? Member::GENDER_FEMALE : Member::GENDER_MALE,
                    'highest_position' => $row->get('chuc_vu_cao_nhat'),
                    'phone' => $row->get('so_dien_thoai'),
                    'email' => $row->get('email'),
                    'specialize' => $row->get('chuyen_mon'),
                    'team_id' => $team->id,
                ]);
            }
        }
    }
}
