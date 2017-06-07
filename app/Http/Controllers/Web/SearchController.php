<?php

namespace App\Http\Controllers\Web;

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

    public function search(Request $request)
    {
        if (!$request->has('query')) {
            return view('home');
        }

        $query = $request->get('query');
        $faqs = \Elastic::searchFaqs($query);
        $contacts = \Elastic::searchContacts($query);

        try {
            if (\Auth::guest()) {
                SearchLog::create([
                    'text' => $query,
                    'ip' => $request->ip(),
                    'faqs_count' => $faqs->count(),
                    'contacts_count' => $contacts->count(),
                ]);
            }
        } catch (Exception $e) {
            // ignored
        }

        if ($request->ajax()) {
            return view('partials.home.results', compact('faqs', 'contacts'));
        }
        return view('home', compact('faqs', 'contacts'));
    }
}
