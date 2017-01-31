<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Datatables;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            /**
             * @var HasMany $article
             */
            $article = Article::query()
                ->join('categories', 'categories.id', '=', 'articles.category_id')
                ->get(['articles.id as id', 'title', 'short_description', 'created_at', 'updated_at', 'name']);
            return Datatables::of($article)
//                ->addColumn('action', function ($article) {
//                    return
//                        '<a href="' . URL::route('manage.$\article.edit', ['id' => $faq->id]) . '" class="btn btn-sm btn-outline green">
//                        <i class="fa fa-edit"></i>Sửa</a>'
//                        . '<a href="' . URL::route('manage.faq.delete', ['id' => $faq->id]) . '" class="btn btn-sm btn-outline red">
//                        <i class="fa fa-trash-o"></i>Xoá</a>';
//                })
                ->make(true);
        }

        return view('article.index');
    }

    public function create()
    {
        $categories = Category::orderBy('id')->pluck('name', 'id');
        return view('article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $cat_ids = Category::pluck('id')->toArray();
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'body' => 'required|string',
            'tags' => 'array',
            'category_id' => ['required', 'integer',
                Rule::in($cat_ids)
            ],
            'image' => 'image'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = Article::create($request->only(['title', 'short_description', 'category_id', 'body']));
        if ($request->has('tags')) {
            $tags = [];
            foreach ($request->get('tags') as $tag_name) {
                /**
                 * @var Tag $tag
                 */
                $tag = Tag::firstOrCreate(['name' => $tag_name]);
                $tags[] = $tag->id;
            }
            $article->syncTags($tags);
        }
        if ($request->hasFile('image')) {
            $file_name = Carbon::now()->timestamp . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/upload'), $file_name);
            $article->image_url = 'img/upload/' . $file_name;
        }
        $article->save();

        \Session::flash('toastr', [
            [
                'title' => 'Tạo mới Tin tức - Hoạt động',
                'message' => 'Đã tạo "' . $request->get('title') . '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }
}
