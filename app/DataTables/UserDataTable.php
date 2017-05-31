<?php

namespace App\DataTables;

use App\Models\User;
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
            ->editColumn('roles_level_max', function ($user) {
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
        $level = \Auth::check() ? \Auth::user()->roleLevel() : 0;
        $query = User::query()
            ->with('roles')
            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
            ->groupBy('users.id')
            ->select('users.*', \DB::raw('max(roles.level) as roles_level_max'))
            ->having('roles_level_max', '<=', $level);

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
            ->addAction(['class' => 'col-md-3', 'title' => 'Hành động'])
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
            'name' => ['title' => 'Tên', 'class' => 'col-md-3'],
            'username' => ['title' => 'Tên đăng nhập', 'class' => 'col-md-3'],
            'roles_level_max' => ['title' => 'Nhóm quyền', 'searchable' => false, 'class' => 'col-md-3'],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [2, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Tên/Tên đăng nhập'
            ],
        ];
    }
}
