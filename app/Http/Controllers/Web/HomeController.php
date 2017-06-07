<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
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
     * @param Request $request
     * @param FaqController $controller
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FaqController $controller)
    {
        if ($request->has('query')) {
            return $controller->search($request);
        }
        return view('home');
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

    public function hong() {
        return redirect("http://hong.sguet.com");
    }
}
