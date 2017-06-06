<?php

namespace App\Http\Controllers\Web;

use App\DataTables\LinksDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers\Web
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
    public function articles()
    {
        $categories = Category::orderBy('id')->get();
        $articles = Article::query()
            ->with('tags')
            ->orderBy('created_at', 'desc')
            ->take(12)
            ->get();
        return view('article.articles', compact('categories', 'articles'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }

    public function google_site_verification() {
        return view('vendor.google.googleeadd1946a0bd73da');
    }

    public function links(LinksDataTable $dataTable) {
        return $dataTable->render('links');
    }

    public function hong() {
        return redirect("http://hong.sguet.com");
    }
}
