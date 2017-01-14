<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class ArticleController.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:51:37pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - article';
        $articles = Article::paginate(6);
        return view('article.index',compact('articles','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - article';
        
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();

        
        $article->title = $request->title;

        
        $article->body = $request->body;

        
        $article->image_url = $request->image_url;

        
        $article->short_description = $request->short_description;

        
        
        $article->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new article has been created !!']);

        return redirect('article');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - article';

        if($request->ajax())
        {
            return URL::to('article/'.$id);
        }

        $article = Article::findOrfail($id);
        return view('article.show',compact('title','article'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - article';
        if($request->ajax())
        {
            return URL::to('article/'. $id . '/edit');
        }

        
        $article = Article::findOrfail($id);
        return view('article.edit',compact('title','article'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $article = Article::findOrfail($id);
    	
        $article->title = $request->title;
        
        $article->body = $request->body;
        
        $article->image_url = $request->image_url;
        
        $article->short_description = $request->short_description;
        
        
        $article->save();

        return redirect('article');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/article/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$article = Article::findOrfail($id);
     	$article->delete();
        return URL::to('article');
    }
}
