<?php

namespace App\DataTables;

use App\Article;
use Yajra\Datatables\Services\DataTable;

class ArticleDatatable extends DataTable
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
            ->addColumn('action', function ($article) {
                return view('article.datatable_action', compact('article'))->render();
            })
            ->editColumn('category_id', function ($article) {
                return $article->category->name;
            })
            ->editColumn('title', function ($article) {
                return view('article.datatable_column_title', compact('article'))->render();
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
        $query = Article::query();

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
            'title' => ['title' => 'Tiêu đề'],
            'short_description' => ['title' => 'Mô tả'],
            'category_id' => ['title' => 'Loại', 'class' => 'col-md-1', 'searchable' => false],
            'created_at' => ['title' => 'Tạo lúc'],
            'updated_at' => ['title' => 'Sửa lúc'],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [3, 'desc']
        ];
    }
}