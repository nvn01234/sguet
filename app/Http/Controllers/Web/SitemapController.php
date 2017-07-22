<?php

namespace App\Http\Controllers\Web;

use File;
use App\Http\Controllers\Controller;
use Response;

class SitemapController extends Controller
{
    public function sitemap() {
        $path = storage_path("sitemap.xml");

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
