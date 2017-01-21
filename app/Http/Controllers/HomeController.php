<?php

namespace App\Http\Controllers;

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
        return view('news', compact('cat_news_id', 'cat_act_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }
}
