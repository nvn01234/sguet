<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqApiController extends Controller
{
    /**
     * Ajax api tìm FAQ qua full text
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $text = $request->get('query', '');
        $text = trim($text);
        $result = collect();
        if ($text !== '') {
            $result = Faq::search($text)->get();
            $result_ids = $result->pluck('id');

            /**
             * @var SearchLog $log
             */
            $log = SearchLog::firstOrCreate(compact('text'));
            $log->update(['search_count' => $log->search_count + 1]);
            $log->syncResults($result_ids);
        }
        return response()->json($result);
    }

    public function syncToSearch()
    {
        Faq::makeAllSearchable();
    }
}
