<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $faq_id = Category::whereName('Q&A')->first(['id'])->id;
        $result = Article::whereCategoryId($faq_id)->get();
        return response($result, 200);
    }
}
