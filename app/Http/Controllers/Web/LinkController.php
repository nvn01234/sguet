<?php

namespace App\Http\Controllers\Web;

use App\DataTables\LinksDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;

class LinkController extends Controller
{
    /**
     * LinkController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content')->except('index');
    }

    public function index(LinksDataTable $dataTable) {
        return $dataTable->render('link.index');
    }

    public function manage(LinksDataTable $dataTable) {
        return $dataTable->render('link.index');
    }

    public function edit($id) {
        $link = Link::findOrFail($id);
        return view('link.edit', compact('link'));
    }

    public function update($id, CreateLinkRequest $request) {
        $link = Link::findOrFail($id);
        $link->update($request->only('url', 'description'));
        \Toastr::append([
            'message' => 'Bạn vừa sửa 1 link'
        ]);
        return redirect()->route('manage.links');
    }

    public function delete($id) {
        $int = Link::destroy($id);
        \Toastr::append([
            'message' => "Bạn vừa xoá $int đường dẫn",
        ]);
        return redirect()->route('manage.links');
    }

    public function create() {
        return view('link.create');
    }

    public function store(CreateLinkRequest $request) {
        Link::create($request->only('url', 'description'));
        \Toastr::append([
            'message' => 'Bạn vừa tạo 1 link',
        ]);
        return redirect()->route('manage.links');
    }
}
