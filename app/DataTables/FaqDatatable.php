<?php

namespace App\DataTables;

use App\Models\Faq;
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
                /**
                 * @var Faq $faq
                 */
                return \Html::link(route('faq.slug', $faq->slug), str_limit($faq->question, 50), ['class' => 'tooltips', 'data-original-title' => $faq->question])->toHtml();
            })
            ->editColumn('paraphrases', function($faq) {
                /**
                 * @var Faq $faq
                 */
                $paraphrases = collect($faq->paraphrases ? explode(',', $faq->paraphrases) : []);
                return view('faq.datatable_paraphrases', compact('paraphrases'))->render();
            })
            ->editColumn('action', function ($faq) {
                return view('partials.faq.action', compact('faq'))->render();
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
            'question' => ['title' => 'Câu hỏi', 'class' => 'col-md-4'],
            'paraphrases' => ['title' => 'Câu hỏi tương tự', 'class' => 'col-md-4'],
            'created_at' => ['title' => 'Tạo lúc', 'class' => 'col-md-1', 'searchable' => false],
            'updated_at' => ['title' => 'Sửa lúc', 'class' => 'col-md-1', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [[2, 'desc']],
            'language' => [
                'searchPlaceholder' => 'Nhập câu hỏi'
            ]
        ];
    }
}
