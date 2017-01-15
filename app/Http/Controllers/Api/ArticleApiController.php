<?php

namespace App\Http\Controllers\Api;

use App\Article;
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
        $result = Article::search($request['q'])->where('category_id', 3)->get();
        return response($result, 200);
    }
}
