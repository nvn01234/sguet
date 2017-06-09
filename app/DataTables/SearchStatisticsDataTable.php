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
                return \Html::link(route('home', compact('query')), str_limit($query, 40), ['class' => 'tooltips', 'data-original-title' => $query])->toHtml();
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
        $query = SearchLog::query();

        if (!\Entrust::can('manage-system')) {
            $query = $query->where('ip', 'NOT LIKE', '66.249.%.%');
        }

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
            'faqs_count' => ['title' => 'Số Q&A', 'searchable' => false],
            'contacts_count' => ['title' => 'Số liên hệ', 'searchable' => false],
            'ip' => ['title' => 'IP'],
            'created_at' => ['title' => 'Thời gian', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [4, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Câu hỏi/IP'
            ]
        ];
    }
}
