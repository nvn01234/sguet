<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Faq;
use App\Team;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faq_id = $request->get('faq');
        if ($faq_id) {
            $faq = Faq::find($faq_id);
            if ($faq) {
                return view('home', compact('faq'));
            }
        }
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articles()
    {
        $cat_news_id = Category::whereName(Category::NAME_NEWS)->first(['id'])->id;
        $cat_act_id = Category::whereName(Category::NAME_ACTIVITIES)->first(['id'])->id;
        $articles = Article::orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        return view('articles', compact('cat_news_id', 'cat_act_id', 'articles'));
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

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function home()
    {
        return redirect()->route('home');
    }
}
