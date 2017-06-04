<?php

namespace App\Http\Controllers\Web;


use App\DataTables\FaqDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFaqRequest;
use App\Models\Faq;
use App\Models\SearchLog;
use App\Models\Tag;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * ManageController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:manage-content')->except('sync', 'search', 'show');
        $this->middleware('permission:manage-system')->only('sync');
        $this->middleware('throttle:60,1')->only('search');
    }

    public function index(FaqDatatable $datatable)
    {
        return $datatable->render('faq.index');
    }

    public function show($id) {
        /**
         * @var Faq $faq
         */
        $faq = Faq::findOrFail($id);
        return redirect()->route('home', ['query' => $faq->question, 'nolog' => true]);
    }

    public function create()
    {
        return view('faq.create');
    }

    public function store(CreateFaqRequest $request)
    {
        $faq = null;
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
        if ($faq) {
            /**
             * @var Faq $faq
             */
            return redirect()->route('faq.show', $faq->id);
        } else {
            return redirect()->route('manage.faq');
        }
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
        return redirect()->route('faq.show', $faq->id);
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
        return redirect()->back();
    }

    public function sync()
    {
        Faq::makeAllSearchable();
    }

    public function search(Request $request)
    {
        $text = $request->get('query', '');
        $text = trim($text);
        $faqs = collect();
        if ($text) {
            $faqs = Faq::search($text)->get();
            if (!$request->get('nolog')) {
                $latest = SearchLog::latest()->first();
                if ($latest->text === $text && $latest->user_id === \Auth::id() && $latest->ip === $request->ip()) {
                    $latest->update([
                        'search_count' => $latest->search_count + 1,
                    ]);
                    $latest->syncResults($faqs->pluck('id'));
                } else {
                    $log = SearchLog::create([
                        'text' => $text,
                        'user_id' => \Auth::id(),
                        'ip' => $request->ip(),
                    ]);
                    $log->syncResults($faqs->pluck('id'));
                }
            }
        }
        return view('partials.home.results', compact('faqs'));
    }
}
