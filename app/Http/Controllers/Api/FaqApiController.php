<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
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
        return null;
    }

    public function show($id) {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }
}
