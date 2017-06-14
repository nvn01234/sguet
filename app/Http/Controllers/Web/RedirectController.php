<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class RedirectController extends Controller
{
    public function hong() {
        return redirect("http://hong.sguet.com");
    }

    public function home() {
        return redirect()->route('home');
    }

    public function tag($tag) {
        return redirect()->route('home', ['query' => $tag]);
    }

    public function articles() {
        return redirect()->route('articles');
    }

    public function rewrite($any) {
        return redirect(route("home") . "/$any");
    }
}
