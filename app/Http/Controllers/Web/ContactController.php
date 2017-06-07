<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use File;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Collections\CellCollection;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;
use Maatwebsite\Excel\Readers\LaravelExcelReader;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;
use Response;

class ContactController extends Controller
{
    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content')->except('index', 'show');
    }

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
                \Toastr::append(['level' => 'success', 'title' => 'Tải lên danh bạ', 'message' => 'Tải lên thành công']);
            } else {
                \Toastr::append(['level' => 'error', 'title' => 'Tải lên danh bạ', 'message' => 'Tệp không đúng định dạng (.xls, .xlsx)']);
            }
        } else {
            \Toastr::append(['level' => 'error', 'title' => 'Tải lên danh bạ', 'message' => 'Không có tệp nào được tải lên']);
        }

        return redirect()->route('contact.index');
    }

    /**
     * @param RowCollection $sheet
     */
    private function readSheet($sheet)
    {
        \Elastic::deleteContacts(Contact::pluck('id'));
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
             * @var \App\Models\Member $member
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
                \Toastr::append(['level' => 'warning', 'title' => 'Có lỗi tại dòng ' . ($index + 2), 'message' => $e->getMessage()]);
            }
        }
        \Elastic::indexContacts(Contact::all());
    }

    public function download($file_name) {
        $path = storage_path("exports/$file_name");

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        File::delete($path);
        return $response;
    }

    public function export(Request $request) {
        /**
         * @var LaravelExcelWriter $writter
         */
        $timestamp = Carbon::now()->timestamp;
        $file_name = "contacts_$timestamp";
        $writter = \Excel::create($file_name, function($excel) {
            /**
             * @var LaravelExcelReader $excel
             */
            $excel->sheet('Danh bạ', function($sheet) {
                /**
                 * @var LaravelExcelWorksheet $sheet
                 */
                $sheet->loadView('contact.download', $this->getExportData());
            });
        });
        $writter->save();

        return redirect()->route('manage.contact.download', "$file_name.xls");
    }

    private function getExportData() {
        /**
         * @var Collection $contacts
         */
        $contacts = Contact::query()
            ->orderBy('parent_id')
            ->orderBy('id')
            ->get()->keyBy('id');

        $contacts->first()->stt = "1";

        foreach ($contacts->slice(1) as $contact) {
            /**
             * @var Contact $contact
             */
            $prev = $contact->getPrevSibling(['id']);
            if ($prev) {
                $prev = $contacts[$prev->id];
                $stts = collect(explode('.', $prev->stt));
                $contact->stt = $stts->reverse()->slice(1)->reverse()->push($stts->last() + 1)->implode('.');
            } else {
                $parent = $contacts[$contact->parent_id];
                $contact->stt = $parent->stt . ".1";
            }
        };

        $contacts = $contacts->sortBy('id')->values();

        return compact('contacts');
    }

    public function show($id, Request $request) {
        $contact = Contact::findOrFail($id);
        if ($request->ajax()) {
            return view('contact.detail', compact('contact'));
        }
        return null;
    }
}
