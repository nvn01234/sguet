<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

class FaqApiController extends Controller
{
    /**
     * Ajax api tìm FAQ qua full text
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $faq_id = Category::whereName(Category::NAME_FAQ)->first(['id'])->id;
        $q = $request['q'];
        $result = Article::search($q)->where('category_id', $faq_id)->get();
        return response($result, 200);
    }


    /**
     * Import index của FAQ lên server Algolia
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function algolia()
    {
        /**
         * @var mixed $faq
         */
        $faq = Category::whereName(Category::NAME_FAQ)->first()->articles();
        $faq->searchable();
        return response("Done", 200);
    }

    public function datatable()
    {
        /**
         * @var HasMany $faq
         */
        $faq = Category::whereName(Category::NAME_FAQ)->first()->articles();
        $faq = $faq->getQuery()->get(['id', 'title', 'short_description', 'created_at', 'updated_at']);
        return Datatables::of($faq)->make(true);
    }
}
