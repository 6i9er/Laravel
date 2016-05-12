<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
//use App\article;
use App\comment;

class commentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function insert(Request $request)
    {

    	$this->validate($request, [
	        'mytext' => 'required',
	        'u_id' => 'required|integer',
	        'post_id' => 'required|integer',
	    ]);
	    DB::table('comments')->insert(
		    ['post_id' => $_POST['post_id'], 'mytext' => $_POST['mytext'] , 'u_id' => $_POST['u_id'] ,'created_at' => date('Y-m-d    h:m') ,'updated_at' => date('Y-m-d    h:m') ]
		);

		return Redirect::to('/posts/'.$_POST['post_id'])->with('message', 'New Article Created');

    	//echo $_POST['title'];
    	
        //return view('articles.create');    
        
    }


    public function delete($id)
    {

    	$comment= DB::table('comments')
            ->where('id', $id)->get();
            if(count($comment) > 0){
            	$post_id =  $comment[0]->post_id; 
            	DB::table('comments')->where('id', '=', $id)->delete();
            	return Redirect::to('/posts/'.$post_id)->with('message', 'Comment Deleted Successful');
            } 
            else{
            	return Redirect::to('/home');
            } 
    	   
        
    }
}
