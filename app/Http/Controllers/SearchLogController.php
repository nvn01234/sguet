<?php

namespace App\Http\Controllers;

use App\DataTables\SearchStatisticsDataTable;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
    /**
     * SearchLogController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SearchStatisticsDataTable $dataTable) {
        return $dataTable->render('search_log.index');
    }
}
