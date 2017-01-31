<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;

/**
 * Class ArticleApiController
 * @package App\Http\Controllers\Api
 */
class ArticleApiController extends Controller
{
    /**
     * Đoạn HTML hiển thị tất cả tin tức - hoạt động theo phân trang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page = request('page', 1);
        $articles = Article::orderBy('created_at', 'desc')
            ->paginate(8, ["*"], 'page', $page + 1);
        return view('api.article_index', compact('articles'));
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
        return view('api.article_show', compact('article'));
    }
}
