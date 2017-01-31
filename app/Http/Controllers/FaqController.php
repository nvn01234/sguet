<?php

namespace App\Http\Controllers;


use App\Faq;
use App\Tag;
use Datatables;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class FaqController extends Controller
{


    /**
     * ManageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            /**
             * @var HasMany $faq
             */
            $faq = Faq::get(['id', 'question', 'created_at', 'updated_at']);
            return Datatables::of($faq)
                ->addColumn('action', function ($faq) {
                    $href = \URL::route('manage.faq.edit', ['id' => $faq->id]);
                    return '<a href="' . $href . '" class="btn btn-primary"><i class="fa fa-edit"></i>Sửa</a>';
                })
                ->make(true);
        }

        return view('faq.index');
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'tags' => 'array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Faq::withoutSyncingToSearch(function () use ($request) {
            $faq = Faq::create($request->except(['_token', 'files', 'tags']));
            if ($request->has('tags')) {
                foreach ($request->get('tags') as $tag_name) {
                    /**
                     * @var Tag $tag
                     */
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    $faq->assignTag($tag);
                    $faq->save();
                }
            }
            $faq->searchable();
        });

        \Session::flash('toastr', [
            [
                'title' => 'Thêm mới Q&A',
                'message' => '"' . $request->get('question') . '" đã được tạo',
            ]
        ]);
        return redirect()->route('manage.faq');
    }

    public function edit($id)
    {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);
        $tags = $faq->tags()->getQuery()->pluck('name', 'name');
        return view('faq.edit', compact('faq', 'tags'));
    }

    public function update($id, Request $request)
    {

    }
}
