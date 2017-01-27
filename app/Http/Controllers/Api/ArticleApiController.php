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

/**
 * Class ArticleApiController
 * @package App\Http\Controllers\Api
 */
class ArticleApiController extends Controller
{
    /**
     * Ajax api tìm FAQ qua full text
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function searchFaq(Request $request)
    {
        $faq_id = Category::whereName(Category::NAME_FAQ)->first(['id'])->id;
        $q = $request['q'];
        $result = Article::search($q)->where('category_id', $faq_id)->get();
        return response($result, 200);
    }

    /**
     * Đoạn HTML hiển thị tất cả tin tức - hoạt động theo phân trang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexNewsActivitiesHtml()
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
    public function showHtml($id)
    {
        /**
         * @var Article $article
         */
        $article = Article::findOrFail($id);
        return view('api.show_news', compact('article'));
    }

    /**
     * Import index của FAQ lên server Algolia
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function indexFaq()
    {
        /**
         * @var mixed $faq
         */
        $faq = Category::whereName(Category::NAME_FAQ)->first()->articles();
        $faq->searchable();
        return response("Done", 200);
    }
}
