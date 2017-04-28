<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Faq;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Readers\LaravelExcelReader;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function manage()
    {
        return view('contact.index');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = \File::extension($file->getClientOriginalName());
            if ($extension === 'xls' || $extension === 'xlsx') {
                $excel = \App::make('excel');
                $excel->load($file, function ($reader) {
                    /**
                     * @var LaravelExcelReader $reader
                     */
                    $collection = $reader->all();
                    if ($collection instanceof SheetCollection) {
                        /**
                         * @var SheetCollection $collection
                         */
                        $sheet = $collection->first();
                        $this->readSheet($sheet);
                    } else if ($collection instanceof RowCollection) {
                        $this->readSheet($collection);
                    }
                });
                \Session::flash('toastr', [
                    ['level' => 'success', 'title' => 'Tải lên danh bạ', 'message' => 'Tải lên thành công'],
                ]);
            } else {
                \Session::flash('toastr', [
                    ['level' => 'error', 'title' => 'Tải lên danh bạ', 'message' => 'Tệp không đúng định dạng (.xls, .xlsx)'],
                ]);
            }
        } else {
            \Session::flash('toastr', [
                ['level' => 'error', 'title' => 'Tải lên danh bạ', 'message' => 'Không có tệp nào được tải lên'],
            ]);
        }

        return redirect()->route('contact.index');
    }

    /**
     * @param RowCollection $sheet
     */
    private function readSheet($sheet)
    {
        Contact::query()->delete();
        $contacts = collect();
        $rows = $sheet
            ->filter(function ($row) {
                /**
                 * @var CellCollection $row
                 */
                return $row->has('stt') && $row->has('ten') && $row->get('stt') && $row->get('ten');
            });
        foreach ($rows as $index => $row) {
            /**
             * @var CellCollection $row
             * @var \App\Member $member
             */
            try {
                $stt = (string)$row->get('stt');
                $stts = explode('.', $stt);
                $parent_id = null;
                if (count($stts) > 1) {
                    $key = implode('.', array_slice($stts, 0, count($stts) - 1));
                    $parent = $contacts->get($key);
                    $parent_id = $parent->id;
                }
                $contact = Contact::create([
                    'name' => $row->get('ten'),
                    'description' => $row->get('chuc_vu'),
                    'phone_cq' => $row->get('sdt_cq'),
                    'phone_nr' => $row->get('sdt_nr'),
                    'phone_dd' => $row->get('sdt_dd'),
                    'fax' => $row->get('fax'),
                    'email' => $row->get('email'),
                    'parent_id' => $parent_id,
                ]);
                $contacts->put($stt, $contact);
            } catch (\Exception $e) {
                \Session::flash('toastr', [
                    ['level' => 'warning', 'title' => 'Tải lên danh bạ', 'message' => 'Có lỗi tại dòng ' . ($index + 2) . ': ' . $e->getMessage()],
                ]);
            }
        }
    }
}
