<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqApiController extends Controller
{
    public function search(Request $request) {
        if ($request->has('query')) {
            $query = $request->get('query');
            $faqs = \Elastic::searchFaqs($query);
            return response()->json($faqs);
        }
    }

    public function test() {
        return 'ok';
    }
}
