<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tag;
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
                            URL::route('manage.article.edit', ['id' => $article->id]),
                            Html::tag('i', '', ['class' => 'fa fa-edit']) . 'Sửa',
                            ['class' => 'btn btn-sm btn-outline green'],
                            null, false
                        )
                        . Html::link(
                            URL::route('manage.article.delete', ['id' => $article->id]),
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
            'image_url' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $article = Article::create($request->only(['title', 'short_description', 'category_id', 'body', 'image_url']));
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
        $article->save();

        \Session::flash('toastr', [
            [
                'title' => 'Tạo mới Tin tức - Hoạt động',
                'message' => 'Đã tạo "' . $request->get('title') . '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }

    public function edit($id)
    {
        /**
         * @var Article $article
         */
        $article = Article::findOrFail($id);
        $categories = Category::pluck('name', 'id');
        return view('article.edit', compact('article', 'categories'));
    }

    public function update($id, Request $request)
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
            'image_url' => 'image_url'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /**
         * @var Article $article
         */
        $article = Article::findOrFail($id);
        $article->update($request->only(['title', 'short_description', 'category_id', 'body', 'image_url']));
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
        $article->save();

        \Session::flash('toastr', [
            [
                'title' => 'Sửa Tin tức - Hoạt động',
                'message' => 'Đã cập nhật "' . $request->get('title') . '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }

    public function destroy($id)
    {
        /**
         * @var Article $article
         */
        $article = Article::findOrFail($id);
        $article->delete();

        \Session::flash('toastr', [
            [
                'title' => 'Xoá Tin tức - Hoạt động',
                'message' => 'Đã xoá "' . $article->title . '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }
}
