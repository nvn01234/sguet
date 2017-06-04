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
            ->editColumn('text', function ($log) {
                /**
                 * @var SearchLog $log
                 */
                $query = e($log->text);
                return \Html::link(route('home', ['query' => $query, 'nolog' => true]), str_limit($query, 40), ['class' => 'tooltips', 'data-original-title' => $query])->toHtml();
            })
            ->editColumn('user.name', function ($log) {
                /**
                 * @var SearchLog $log
                 */
                return $log->user ? $log->user->name : '';
            })
            ->editColumn('action', function($log) {
                /**
                 * @var SearchLog $log
                 */
                return \Html::link(route('manage.search_log.delete', $log->id), '<i class="fa fa-trash"></i> Xoá', ['class' => 'btn btn-sm btn-outline red'], null, false)->toHtml();
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
        $query = SearchLog::query()->withCount('results')->with('user');

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
            ->addAction(['title' => 'Hành động'])
            ->ajax('')
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
            'ip' => ['title' => 'IP'],
            'user.name' => ['title' => 'Người dùng'],
            'updated_at' => ['title' => 'Thời gian', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [5, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Câu hỏi/IP/Người dùng'
            ]
        ];
    }
}
