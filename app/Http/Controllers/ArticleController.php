<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use Datatables;
use Html;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use URL;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $articles = Article::query()
                ->join('categories', 'categories.id', '=', 'articles.category_id')
                ->select([
                    'articles.id as id',
                    'articles.title as title',
                    'articles.short_description as short_description',
                    'categories.name as category_name',
                    'articles.created_at as created_at',
                    'articles.updated_at as updated_at',
                ]);
            return Datatables::of($articles)
                ->editColumn('title', function ($article) {
                    return Html::link(
                        URL::route('articles') . '#cbp=' . URL::route('api.article.show', ['id' => $article->id]),
                        $article->title,
                        ['target' => '_blank']
                    );
                })
                ->addColumn('action', function ($article) {
                    return
                        Html::link(
                            '#' . $article->id,
                            Html::tag('i', '', ['class' => 'fa fa-edit']) . 'Sửa',
                            ['class' => 'btn btn-sm btn-outline green'],
                            null, false
                        )
                        . Html::link(
                            '#' . $article->id,
                            Html::tag('i', '', ['class' => 'fa fa-trash-o']) . 'Xoá',
                            ['class' => 'btn btn-sm btn-outline red'],
                            null, false
                        );
                })
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
            $request->file('image')->move(public_path('storage'), $file_name);
            $article->image_url = public_path('storage/' . $file_name);
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
