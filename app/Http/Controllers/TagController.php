<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class TagController.
 *
 * @author  The scaffold-interface created at 2017-01-11 05:19:59pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - tag';
        $tags = Tag::paginate(6);
        return view('tag.index',compact('tags','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - tag';
        
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();

        
        $tag->name = $request->name;

        
        
        $tag->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new tag has been created !!']);

        return redirect('tag');
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
        $title = 'Show - tag';

        if($request->ajax())
        {
            return URL::to('tag/'.$id);
        }

        $tag = Tag::findOrfail($id);
        return view('tag.show',compact('title','tag'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - tag';
        if($request->ajax())
        {
            return URL::to('tag/'. $id . '/edit');
        }

        
        $tag = Tag::findOrfail($id);
        return view('tag.edit',compact('title','tag'  ));
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
        $tag = Tag::findOrfail($id);
    	
        $tag->name = $request->name;
        
        
        $tag->save();

        return redirect('tag');
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
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/tag/'. $id . '/delete');

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
     	$tag = Tag::findOrfail($id);
     	$tag->delete();
        return URL::to('tag');
    }
}
