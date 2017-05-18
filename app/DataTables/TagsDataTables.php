<?php

namespace App\DataTables;

use App\Models\Tag;
use Yajra\Datatables\Services\DataTable;

class TagsDataTables extends DataTable
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
//            ->editColumn('action', function ($tag) {
//                return view('tag.datatable_action', compact('tag'))->render();
//            })
            ->editColumn('faqs_count', function ($tag) {
                return view('tag.datatable_column_faqs_count', compact('tag'))->render();
            })
            ->editColumn('articles_count', function ($tag) {
                return view('tag.datatable_column_articles_count', compact('tag'))->render();
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
        $query = Tag::query()->withCount('faqs')->withCount('articles')
        ->has('faqs')->orHas('articles');

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
                        'error' => '',
                    ])
//                    ->addAction(['title' => 'Hành động'])
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
            'name' => ['title' => 'Tên'],
            'faqs_count' => ['title' => 'Số Q&A', 'searchable' => false],
            'articles_count' => ['title' => 'Số tin tức - hoạt động', 'searchable' => false]
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [0, 'asc'],
            'language' => [
                'searchPlaceholder' => 'Nhập tên nhãn'
            ]
        ];
    }
}
