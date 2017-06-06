<?php

namespace App\DataTables;

use App\Models\Link;
use Yajra\Datatables\Services\DataTable;

class LinksDataTable extends DataTable
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
            ->editColumn('url', function($link) {
                return \Html::link($link->url, null, ['target' => '_blank'])->toHtml();
            })
            ->editColumn('action', function($link) {
                return view('link.datatable_action', compact('link'))->render();
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
        $query = Link::query();
        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        $builder =  $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->parameters($this->getBuilderParameters());
        if (\Entrust::can('manage-content')) {
            $builder = $builder->addAction(['title' => 'Hành động']);
        }
        return $builder;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'url' => ['title' => 'Đường dẫn'],
            'description' => ['title' => 'Mô tả']
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [0, 'desc'],
        ];
    }
}
