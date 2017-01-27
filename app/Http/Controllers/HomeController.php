<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Team;

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
        $faq_id = \Request::get('faq');
        $faq = null;
        if ($faq_id) {
            $faq = Article::find($faq_id);
            if (!($faq && $faq->category->name === Category::NAME_FAQ)) {
                $faq = null;
            }
        }
        return view('home', compact('faq'));
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
        $teams = Team::all();
        $root_id = Team::whereNull('parent_id')->first(['id'])->id;
        return view('about', compact('teams', 'root_id'));
    }
}
