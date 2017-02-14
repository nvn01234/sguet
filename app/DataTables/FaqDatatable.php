<?php

namespace App\DataTables;

use App\Faq;
use Yajra\Datatables\Services\DataTable;

class FaqDatatable extends DataTable
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
            ->editColumn('question', function ($faq) {
                return view('faq.datatable_column_question', compact('faq'))->render();
            })
            ->addColumn('action', function ($faq) {
                return view('faq.datatable_action', compact('faq'))->render();
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
        $query = Faq::query();

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
            ->ajax('')
            ->addAction(['title' => 'Hành động', 'class' => 'col-md-2'])
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
            'question' => ['title' => 'Câu hỏi'],
            'created_at' => ['title' => 'Tạo lúc'],
            'updated_at' => ['title' => 'Sửa lúc'],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [[1, 'desc']],
        ];
    }
}
