<?php

namespace App\Http\Controllers;


use App\Faq;
use App\Tag;
use Datatables;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use URL;

class FaqController extends Controller
{
    /**
     * ManageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function actionButton($action)
    {
        return
            '<a href="' . $action['url'] . '" class="btn btn-sm btn-outline ' . $action['color'] . '">'
            . '<i class="fa fa-' . $action['icon'] . '"></i>'
            . $action['name']
            . '</a>';
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
                    $actions = [
                        [
                            'name' => 'Sửa',
                            'url' => URL::route('manage.faq.edit', ['id' => $faq->id]),
                            'icon' => 'edit',
                            'color' => 'green'
                        ], [
                            'name' => 'Xoá',
                            'url' => URL::route('manage.faq.delete', ['id' => $faq->id]),
                            'icon' => 'trash-o',
                            'color' => 'red'
                        ]
                    ];
                    $str = '';
                    foreach ($actions as $action) {
                        $str .= $this->actionButton($action);
                    }
                    return $str;
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
            $faq = Faq::create($request->only(['question', 'answer']));
            if ($request->has('tags')) {
                $tags = [];
                foreach ($request->get('tags') as $tag_name) {
                    /**
                     * @var Tag $tag
                     */
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    $tags[] = $tag->id;
                }
                $faq->syncTags($tags);
            }

            $faq->save();
            $faq->searchable();
        });

        \Session::flash('toastr', [
            [
                'title' => 'Tạo mới Q&A',
                'message' => 'Đã tạo "' . $request->get('question') . '"',
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
        return view('faq.edit', compact('faq'));
    }

    public function update($id, Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'tags' => 'array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);

        Faq::withoutSyncingToSearch(function () use ($request, $faq) {
            $faq->update($request->only(['question', 'answer']));

            if ($request->has('tags')) {
                $tags = [];
                foreach ($request->get('tags') as $tag_name) {
                    /**
                     * @var Tag $tag
                     */
                    $tag = Tag::firstOrCreate(['name' => $tag_name]);
                    $tags[] = $tag->id;
                }
                $faq->syncTags($tags);
            } else {
                $faq->removeTag();
            }

            $faq->save();
            $faq->searchable();
        });

        \Session::flash('toastr', [
            [
                'title' => 'Sửa Q&A',
                'message' => 'Đã cập nhật "' . $request->get('question') . '"',
            ]
        ]);
        return redirect()->route('manage.faq');
    }

    public function destroy($id)
    {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);
        $faq->unsearchable();
        $faq->delete();

        \Session::flash('toastr', [
            [
                'title' => 'Sửa Q&A',
                'message' => 'Đã xoá "' . $faq->question . '"',
            ]
        ]);
        return redirect()->route('manage.faq');
    }
}
