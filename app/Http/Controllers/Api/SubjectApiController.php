<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectApiController extends Controller
{
    public function search(Request $request) {
        if ($request->has('query')) {
            $query = $request->get('query');
            $subjects = \Elastic::searchSubjects($query);
            return response()->json($subjects);
        }
        return null;
    }

    public function show($id) {
        $subject = Subject::findOrFail($id);
        return response()->json($subject);
    }
}
