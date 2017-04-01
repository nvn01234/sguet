<?php

namespace App\Http\Controllers\Api;

use App\Faq;
use App\SearchLog;
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
        $text = $request->get('q', '');
        $text = trim($text);
        if ($text !== '') {
            $result = Faq::search($text)->get();
            $result_ids = $result->pluck('id');
            /**
             * @var SearchLog $log
             */
            $log = SearchLog::firstOrCreate(compact('text'));
            $log->update(['search_count' => $log->search_count + 1]);
            $log->syncResults($result_ids);
            return response($result, 200);
        }
    }

    public function destroy(Request $request)
    {
        if (!$request->has('id')) {
            abort(404);
        }

        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($request->get('id'));
        $faq->unsearchable();
        $faq->delete();

        $content = [
            'title' => 'Xoá Q&A',
            'message' => 'Đã xoá ' . $faq->question
        ];

        return response($content, 200);
    }

    public function syncToSearch() {
        Faq::makeAllSearchable();
    }
}
