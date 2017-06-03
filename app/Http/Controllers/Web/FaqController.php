<?php

namespace App\Http\Controllers\Web;


use App\DataTables\FaqDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFaqRequest;
use App\Models\Faq;
use App\Models\Tag;

class FaqController extends Controller
{
    /**
     * ManageController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content')->except('sync');
        $this->middleware('permission:manage-system')->only('sync');
    }

    public function index(FaqDatatable $datatable)
    {
        return $datatable->render('faq.index');
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(CreateFaqRequest $request)
    {
        Faq::withoutSyncingToSearch(function () use ($request) {
            $faq = Faq::create($request->only(['question', 'answer', 'paraphrases']));
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
            if (env('APP_ENV') === 'production') {
                $faq->searchable();
            }
        });

        \Toastr::append([
            'title' => 'Tạo mới Q&A',
            'message' => 'Đã tạo "' . $request->get('question') . '"',
        ]);
        return redirect()->route('manage.faq');
    }

    public function edit($id)
    {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);
        $paraphrases = explode(',', $faq->paraphrases);
        return view('faq.edit', compact('faq', 'paraphrases'));
    }

    public function update($id, CreateFaqRequest $request)
    {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);

        Faq::withoutSyncingToSearch(function () use ($request, $faq) {
            $faq->update($request->only(['question', 'answer', 'paraphrases']));
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

            if (env('APP_ENV') === 'production') {
                $faq->searchable();
            }
        });

        \Toastr::append([
            'title' => 'Sửa Q&A',
            'message' => 'Đã cập nhật "' . $request->get('question') . '"',
        ]);
        return redirect()->route('manage.faq');
    }

    public function destroy($id)
    {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);
        if (env('APP_ENV') === 'production') {
            $faq->unsearchable();
        }
        $faq->delete();

        \Toastr::append([
            'title' => 'Sửa Q&A',
            'message' => 'Đã xoá "' . $faq->question . '"',
        ]);
        return redirect()->route('manage.faq');
    }

    public function sync()
    {
        Faq::makeAllSearchable();
    }
}
