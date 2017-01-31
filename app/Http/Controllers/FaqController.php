<?php

namespace App\Http\Controllers;


use App\Faq;
use App\Tag;
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

    public function index()
    {
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
}
