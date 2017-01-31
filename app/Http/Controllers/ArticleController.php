<?php
/**
 * Created by PhpStorm.
 * User: nguye
 * Date: 31/01/2017
 * Time: 8:19 CH
 */
namespace App\Http\Controllers;


use App\Article;
use App\Tag;
use Datatables;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use URL;


class ArticleController extends Controller {

    /**
     * ArticleController constructor.
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
    }  public function index(Request $request)
{
    if ($request->ajax()) {
        /**
         * @var HasMany $article
         */
        $article = Article::get(['id', 'title', 'created_at', 'updated_at']);
        return Datatables::of($article)
            ->addColumn('action', function ($article) {
                $actions = [
                    [
                        'name' => 'Sửa',
                        'url' => URL::route('manage.article.edit', ['id' => $article->id]),
                        'icon' => 'edit',
                        'color' => 'green'
                    ], [
                        'name' => 'Xoá',
                        'url' => URL::route('manage.article.delete', ['id' => $article->id]),
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

    return view('article.index');
}
    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'body' => 'required|text',
            'image_url' => 'array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        Article::withoutSyncingToSearch(function () use ($request) {
            $article = Article::create($request->only(['title', 'short_description', 'body', 'image_url']));
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
            $article->searchable();
        });

        \Session::flash('toastr', [
            [
                'title' => 'Tạo mới Tin tức',
                'message' => 'Đã tạo "' . $request->get('title') . '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }

    public function edit($id)
    {
        /**
         * @var Article $article
         *
         */
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update($id, Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'body' => 'required|text',
            'image_url' => 'array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        /**
         * @var Article $article
         *
         */
        $article = Article::findOrFail($id);

        Article::withoutSyncingToSearch(function () use ($request, $article) {
            $article->update($request->only(['title', 'short_description', 'body', 'image_url']));
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
            } else {
                $article->removeTag();
            }

            $article->save();
            $article->searchable();
        });

        \Session::flash('toastr', [
            [
                'title' => 'Sửa Tin tức',
                'message' => 'Đã cập nhật "' . $request->get('question') . '"',
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
        $article->unsearchable();
        $article->delete();

        \Session::flash('toastr', [
            [
                'title' => 'Sửa Q&A',
                'message' => 'Đã xoá "' . $article->title. '"',
            ]
        ]);
        return redirect()->route('manage.article');
    }
}