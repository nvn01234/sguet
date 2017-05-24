<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class ArticleApiController
 * @package App\Http\Controllers\Api
 */
class ArticleApiController extends Controller
{
    /**
     * Đoạn HTML hiển thị tất cả tin tức - hoạt động theo phân trang
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $articles = Article::query()
            ->with('tags')
            ->orderBy('created_at', 'desc')
            ->paginate(12, ["*"], 'page', $page + 1);
        return view('api.article_index', compact('articles'));
    }
}
