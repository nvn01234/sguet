<?php

namespace App\Http\Controllers\Web;

use App\DataTables\ArticleDatatable;
use App\DataTables\FaqDatatable;
use App\DataTables\TagsDataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * TagController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(TagsDataTables $dataTables) {
        return $dataTables->render('tag.index');
    }

    public function faqs($id, FaqDatatable $datatable) {
        return $datatable->setTagId($id)->render('faq.index');
    }

    public function articles($id, ArticleDatatable $datatable) {
        return $datatable->setTagId($id)->render('article.index');
    }
}
