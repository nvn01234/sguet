<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Readers\LaravelExcelReader;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $excel = \App::make('excel');
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
        $team = \App\Team::firstOrNew(['name' => $sheet_title_parts[0]]);
        $team->year = $sheet_title_parts[1];
        $team->save();

        foreach ($sheet->all() as $row) {
            /**
             * @var CellCollection $row
             * @var \App\Member $member
             */
            if ($row->get('ho_va_ten')) {
                $member = new \App\Member();
                $member->name = $row->get('ho_va_ten');
                $member->birthday = $row->get('ngay_sinh');
                $member->class = $row->get('lop');
                $member->gender = $row->get('nu') === "x" ? \App\Member::GENDER_FEMALE : \App\Member::GENDER_MALE;
                $member->highest_position = $row->get('chuc_vu_cao_nhat');
                $member->phone = $row->get('so_dien_thoai');
                $member->email = $row->get('email');
                $member->specialize = $row->get('chuyen_mon');
                $member->team_id = $team->id;
                $member->save();
            }
        }
    }
}
