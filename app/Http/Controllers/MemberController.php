<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use Amranidev\Ajaxis\Ajaxis;
use URL;

/**
 * Class MemberController.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:48:18pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - member';
        $members = Member::paginate(6);
        return view('member.index',compact('members','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - member';
        
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Member();

        
        $member->name = $request->name;

        
        $member->avatar_url = $request->avatar_url;

        
        $member->class = $request->class;

        
        $member->joined_date = $request->joined_date;

        
        
        $member->save();

        $pusher = App::make('pusher');

        //default pusher notification.
        //by default channel=test-channel,event=test-event
        //Here is a pusher notification example when you create a new resource in storage.
        //you can modify anything you want or use it wherever.
        $pusher->trigger('test-channel',
                         'test-event',
                        ['message' => 'A new member has been created !!']);

        return redirect('member');
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
        $title = 'Show - member';

        if($request->ajax())
        {
            return URL::to('member/'.$id);
        }

        $member = Member::findOrfail($id);
        return view('member.show',compact('title','member'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - member';
        if($request->ajax())
        {
            return URL::to('member/'. $id . '/edit');
        }

        
        $member = Member::findOrfail($id);
        return view('member.edit',compact('title','member'  ));
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
        $member = Member::findOrfail($id);
    	
        $member->name = $request->name;
        
        $member->avatar_url = $request->avatar_url;
        
        $member->class = $request->class;
        
        $member->joined_date = $request->joined_date;
        
        
        $member->save();

        return redirect('member');
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
        $msg = Ajaxis::MtDeleting('Warning!!','Would you like to remove This?','/member/'. $id . '/delete');

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
     	$member = Member::findOrfail($id);
     	$member->delete();
        return URL::to('member');
    }
}
