<?php

namespace App\DataTables;

use App\Models\Feedback;
use Yajra\Datatables\Services\DataTable;

class FeedbacksDataTable extends DataTable
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
            ->editColumn('name', function($feedback) {
                return e($feedback->name);
            })
            ->editColumn('email', function ($feeddback) {
                return $feeddback->email ? \Html::mailto($feeddback->email)->toHtml() : '';
            })
            ->editColumn('message', function ($feedback) {
                return e($feedback->message);
            })
            ->editColumn('type', function ($feedback) {
                $type = Feedback::TYPE[$feedback->type];
                $label = Feedback::TYPE_LABEL[$feedback->type];
                return '<span class="label label-' . $label . '">' . $type . '</span>';
            })
            ->editColumn('status', function ($feedback) {
                $status = Feedback::STATUS[$feedback->status];
                $label = Feedback::STATUS_LABEL[$feedback->status];
                return '<span class="label label-' . $label . '">' . $status . '</span>';
            })
            ->editColumn('action', function ($feedback) {
                return view('feedback.datatable_action', compact('feedback'));
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
        $query = Feedback::query()
            ->with('user');

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
            'name' => ['title' => 'Người gửi'],
            'email' => ['title' => 'Email'],
            'message' => ['title' => 'Nội dung'],
            'type' => ['title' => 'Loại', 'searchable' => false],
            'created_at' => ['title' => 'Gửi lúc', 'searchable' => false],
            'status' => ['title' => 'Tình trạng', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [4, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Người gửi/Email/Nội dung'
            ]
        ];
    }
}
