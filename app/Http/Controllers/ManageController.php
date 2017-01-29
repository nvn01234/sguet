<?php

namespace App\Http\Controllers;


class ManageController extends Controller
{


    /**
     * ManageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manageFaq()
    {
        return view('manage.faq');
    }
}
