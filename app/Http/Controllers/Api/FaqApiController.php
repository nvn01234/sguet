<?php

namespace App\Http\Controllers\Api;

use App\Faq;
use Datatables;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqApiController extends Controller
{
    /**
     * Ajax api tìm FAQ qua full text
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $result = Faq::search($q)->get();
        return response($result, 200);
    }


    /**
     * Import index của FAQ lên server Algolia
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function algolia()
    {
        Faq::makeAllSearchable();
        return response("Done", 200);
    }

    public function datatable()
    {
        /**
         * @var HasMany $faq
         */
        $faq = Faq::get(['id', 'question', 'created_at', 'updated_at']);
        return Datatables::of($faq)->make(true);
    }
}
