<?php

namespace App\Http\Controllers\Web;

use App\DataTables\SearchStatisticsDataTable;
use App\Http\Controllers\Controller;
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
}
