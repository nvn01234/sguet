<?php

namespace App\Http\Controllers\Web;

use App\Models\Contact;
use App\Models\Faq;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class SearchController extends Controller
{


    /**
     * SearchController constructor.
     */
    public function __construct()
    {
        $this->middleware('throttle:60,1');
    }

    function localSearchFaqs($query) {
        $faqs = Faq::query()->where("question", "LIKE", $query)->orWhere("paraphrases", "LIKE", $query)->get();
        return $faqs;
    }

    function localSearchContacts($query) {
        $contacts = Contact::query()->where("name", "LIKE", $query)->get();
        return $contacts;
    }

    public function search(Request $request)
    {
        if (!$request->has('query') || $request->get("query")->trim() == "") {
            return view('home');
        }

        $query = $request->get("query")->trim();

        $query_sql = collect(explode(" ", $query))->implode(" * ");
        $faqs = $this->localSearchFaqs($query_sql);
        $contacts = $this->localSearchContacts($query_sql);

//        $faqs = \Elastic::searchFaqs($query);
//        $contacts = \Elastic::searchContacts($query);
//
//        try {
//            if (\Auth::guest()) {
//                SearchLog::create([
//                    'text' => $query,
//                    'ip' => $request->ip(),
//                    'faqs_count' => $faqs->count(),
//                    'contacts_count' => $contacts->count(),
//                ]);
//            }
//        } catch (Exception $e) {
//            // ignored
//        }

        if ($request->ajax()) {
            return view('partials.home.results', compact('faqs', 'contacts'));
        }
        return view('home', compact('faqs', 'contacts'));
    }
}
