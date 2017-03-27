<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Faq;
use App\Tag;
use App\Team;
use DB;
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
        $categories = Category::orderBy('id')->get();
        $articles = Article::query()
            ->with('tags')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        return view('articles', compact('categories', 'articles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function home()
    {
        return redirect()->route('home');
    }
}
