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
            ->editColumn('action', function ($user){
                return view('user.datatable_action', compact('user'))->render();
            })
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
        $query = User::query()->with('roles')->select('users.*');

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
            ->addAction(['class' => 'col-md-2', 'title' => 'Hành động'])
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
            'name' => ['title' => 'Tên', 'class' => 'col-md-2'],
            'username' => ['title' => 'Tên đăng nhập', 'class' => 'col-md-2'],
            'roles' => ['title' => 'Quyền', 'orderable' => false, 'searchable' => false, 'class' => 'col-md-2'],
            'created_at' => ['title' => 'Tạo lúc', 'class' => 'col-md-2', 'searchable' => false],
            'updated_at' => ['title' => 'Sửa lúc', 'class' => 'col-md-2', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [3, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Nhập Tên hoặc Tên đăng nhập'
            ],
        ];
    }
}
