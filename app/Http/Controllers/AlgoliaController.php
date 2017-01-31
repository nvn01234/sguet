<?php

namespace App\Http\Controllers;


use App\Faq;

class AlgoliaController extends Controller
{
    /**
     * Import index của FAQ lên server Algolia
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function import()
    {
        Faq::makeAllSearchable();
        return response("Done", 200);
    }

    public function setSettings()
    {
        Faq::setSettings();
        return response("Done", 200);
    }
}
