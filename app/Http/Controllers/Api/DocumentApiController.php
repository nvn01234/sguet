<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentApiController extends Controller
{
    public function search(Request $request) {
        if ($request->has('query')) {
            $query = $request->get('query');
            $documents = \Elastic::searchDocuments($query);
            return response()->json($documents);
        }
        return null;
    }

    public function show($id) {
        $document = Document::findOrFail($id);
        return response()->json($document);
    }
}
