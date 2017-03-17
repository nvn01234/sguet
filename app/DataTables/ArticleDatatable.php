<?php

namespace App\DataTables;

use App\Article;
use Yajra\Datatables\Services\DataTable;

class ArticleDatatable extends DataTable
{
    private $tag_id = null;

    /**
     * @param int $tag_id
     * @return $this
     */
    public function setTagId($tag_id)
    {
        $this->tag_id = $tag_id;
        return $this;
    }

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('action', function ($article) {
                return view('article.datatable_action', compact('article'))->render();
            })
            ->editColumn('category_id', function ($article) {
                /**
                 * @var Article $article
                 */
                $category = $article->category;
                return view('article.datatable_column_category', compact('category'))->render();
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
        if ($this->tag_id != null) {
            $query = Article::query()
                ->with('category')
                ->join('article_tag', 'article_tag.article_id', '=', 'articles.id')
                ->where('article_tag.tag_id', '=', $this->tag_id)
                ->groupBy('articles.id')
                ->select('articles.*');
        } else {
            $query = Article::query()->with('category')->select('articles.*');
        }

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
            ->addAction(['title' => 'Hành động', 'class' => 'col-md-1'])
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
            'title' => ['title' => 'Tiêu đề', 'class' => 'col-md-3'],
            'short_description' => ['title' => 'Mô tả', 'class' => 'col-md-3'],
            'category_id' => ['title' => 'Loại', 'class' => 'col-md-1', 'searchable' => false],
            'created_at' => ['title' => 'Tạo lúc', 'class' => 'col-md-1', 'searchable' => false],
            'updated_at' => ['title' => 'Sửa lúc', 'class' => 'col-md-1', 'searchable' => false],
        ];
    }

    protected function getBuilderParameters()
    {
        return [
            'order' => [3, 'desc'],
            'language' => [
                'searchPlaceholder' => 'Nhập tiêu đề hoặc Mô tả'
            ]
        ];
    }
}
