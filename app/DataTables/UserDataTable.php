<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UserDataTable extends DataTable
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
//            ->addColumn('action', 'path.to.action.view')
            ->addColumn('roles', function ($user) {
                /**
                 * @var User $user
                 */
                $roles = $user->roles;
                return view('user.datatable_column_roles', compact('roles'))->render();
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
        $query = User::query();

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
//                    ->addAction(['width' => '80px'])
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
            'username' => ['title' => 'Tên đăng nhập'],
            'roles' => ['title' => 'Quyền', 'orderable' => false, 'searchable' => false],
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
