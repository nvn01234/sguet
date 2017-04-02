<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Readers\LaravelExcelReader;

class ContactController extends Controller
{
    public function index() {
        return view('contact.index');
    }

    public function manage() {
        return view('contact.index', ['from_manage' => true]);
    }

    public function upload(Request $request) {
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
        foreach ($sheet->all() as $row) {
            /**
             * @var CellCollection $row
             * @var \App\Member $member
             */
            if ($row->has('stt') && $row->has('ten')) {
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
            }
        }
    }
}
