<?php

namespace App\Http\Controllers\Web;

use App\DataTables\LinksDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\DeleteContentRequest;
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

    public function delete($id, DeleteContentRequest $request) {
        Link::destroy($id);
        \Toastr::append([
            'level' => 'success',
            'title' => "Xoá đường dẫn thành công",
        ]);
        if ($request->ajax()) {
            return response()->json(['redirectTo' => route('manage.links')]);
        } else {
            return redirect()->route('manage.links');
        }
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
