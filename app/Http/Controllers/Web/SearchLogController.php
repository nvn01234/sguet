<?php

namespace App\Http\Controllers\Web;

use App\DataTables\SearchStatisticsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CleanupSearchLogRequest;
use App\Http\Requests\DeleteContentRequest;
use App\Models\SearchLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
    /**
     * SearchLogController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content');
    }

    public function index(SearchStatisticsDataTable $dataTable) {
        return $dataTable->render('search_log.index');
    }

    public function delete($id, DeleteContentRequest $request) {
        SearchLog::destroy($id);
        \Toastr::append([
            'title' => "Đã chuyển 1 mục vào thùng rác"
        ]);

        if ($request->ajax()) {
            return response()->json(['redirectTo' => route('manage.search_log')]);
        } else {
            return redirect()->route('manage.search_log');
        }
    }

    public function cleanup(CleanupSearchLogRequest $request) {
        $option = $request->get('option');
        $ids = [];
        switch ($option) {
            case "keep_today":
                $today = Carbon::today();
                $ids = SearchLog::query()->where('updated_at', "<", $today->toDateString())->pluck('id')->toArray();
                break;
            case "keep_7_days":
                $day = Carbon::today()->addDay(-7);
                $ids = SearchLog::query()->where('updated_at', "<", $day->toDateString())->pluck('id')->toArray();
                break;
            case "keep_this_month":
                $today = Carbon::today();
                $day = Carbon::create($today->year, $today->month, 1);
                $ids = SearchLog::query()->where('updated_at', "<", $day->toDateString())->pluck('id')->toArray();
                break;
            case "keep_nothing":
                $ids = SearchLog::pluck('id')->toArray();
                break;
        }
        SearchLog::destroy($ids);
        \Toastr::append([
            'title' => 'Dọn dẹp lịch sử tìm kiếm',
            'message' => 'Đã chuyển ' . count($ids) . ' mục vào thùng rác'
        ]);
        return redirect()->back();
    }
}
