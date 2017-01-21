<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {
        $cat_news_id = Category::whereName(Category::NAME_NEWS)->first(['id'])->id;
        $cat_act_id = Category::whereName(Category::NAME_ACTIVITIES)->first(['id'])->id;
        $articles = Article::whereIn('category_id', [$cat_news_id, $cat_act_id])
            ->newQuery()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        return view('news', compact('cat_news_id', 'cat_act_id', 'articles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }
}
