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

    public function indexNewsAndActivities()
    {
        $articles = Category::whereName(Category::NAME_NEWS)
            ->orWhere('name', '=', Category::NAME_ACTIVITIES)
            ->join('articles', 'articles.category_id', '=', 'categories.id')
            ->orderBy('created_at', 'desc')
            ->paginate(8, ['articles.*']);
        return view('api.index_news', compact('articles'));
    }
}
