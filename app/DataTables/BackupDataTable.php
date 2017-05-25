<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;

class BackupDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->of($this->query())
            ->addColumn('action', function ($file) {
                return view('backup.dt_action', compact('file'))->render();
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        $folder_name = config('laravel-backup.backup.name');

        $files = collect(\Storage::files($folder_name))
            ->map(function($file_path) {
                $name = collect(explode('/', $file_path))->last();
                $size = \Storage::size($file_path) / (1024 * 1024);
                return (object) compact('name', 'size');
            });

        return $files;
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
                    ->addAction(['title' => 'Hành động'])
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
            'name' => ['title' => 'Tên file'],
            'size' => ['title' => 'Dung lượng (MB)', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [0, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Tên file'
            ]
        ];
    }
}
