<?php

namespace App\DataTables;

use App\Models\SearchLog;
use Yajra\Datatables\Services\DataTable;

class SearchStatisticsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('text', function($log) {
                /**
                 * @var SearchLog $log
                 */
                return e($log->text);
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = SearchLog::query()->withCount('results');

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax([
                        'url' => '',
                        'error' => ''
                    ])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'text' => ['title' => 'Câu hỏi'],
            'search_count' => ['title' => 'Số lần', 'searchable' => false],
            'results_count' => ['title' => 'Số kết quả', 'searchable' => false],
            'updated_at' => ['title' => 'Lần gần nhất', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [3, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Nhập câu hỏi'
            ]
        ];
    }
}
