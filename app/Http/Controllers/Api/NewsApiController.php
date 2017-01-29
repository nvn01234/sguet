<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Category;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\Util\Json;
use Searchy;
use Yajra\Datatables\Facades\Datatables;

/**
 * Class ArticleApiController
 * @package App\Http\Controllers\Api
 */
class NewsApiController extends Controller
{
    /**
     * Đoạn HTML hiển thị tất cả tin tức - hoạt động theo phân trang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cat_ids = Category::whereName(Category::NAME_NEWS)->orWhere('name', '=', Category::NAME_ACTIVITIES)->get(['id'])->toArray();
        $page = request('page', 1);
        $articles = Article::whereIn('category_id', $cat_ids)
            ->orderBy('created_at', 'desc')
            ->paginate(8, ["*"], 'page', $page + 1);
        return view('api.index_news', compact('articles'));
    }

    /**
     * Đoạn HTML hiển thị một tin tức - hoạt động theo id
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        /**
         * @var Article $article
         */
        $article = Article::findOrFail($id);
        return view('api.show_news', compact('article'));
    }
}
