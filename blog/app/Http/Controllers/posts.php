<?php

namespace App\Http\Controllers;



/*use Illuminate\Http\Request;

use App\Http\Requests;*/


use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\article;
use App\comment;

class posts extends Controller
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

    public function index()
    {
        $articles= DB::table('articles')
            ->join('users', 'articles.u_id', '=', 'users.id')->get();
        //$articles=article::all();


        if(count($articles) > 0){
            //var_dump($articles);
            return view('home' , ['articles' => $articles]);    
        }
        else{
            echo "No Data Found";

        
        
        //return view('home' , , ['tasks' => $tasks]);
        }
    }

    public function show($id)
    {

        $article= DB::table('posts')
            ->where('p_id', $id)->get();

        $comments= DB::table('comments')
            ->where('post_id', $id)->get();    
        //var_dump($article);


        if(count($article) > 0){
            //var_dump($articles);
            return view('articles/show' , ['article' => $article , 'comments' => $comments]);    
        }
        else{
            echo "No Data Found";
        }
    }

    public function create()
    {
    	
        return view('articles.create');    
        
    }

    public function update_form($id)
    {
        //echo "aaaaaaaaaa";
        $article= DB::table('posts')
            ->where('p_id', $id)->get();
            if(count($article) > 0){
                return view('articles.update' , ['article' => $article]);         
                
                //return Redirect::to('/home');
            } 
            else{
                return Redirect::to('/home');
            } 
        
            
        
    }


    public function update(Request $request)
    {
        
        $article= DB::table('posts')
            ->where('p_id', $_POST['post_id'])->get();
            if(count($article) > 0){
                if($article[0]->u_id == Auth::user()->id){
                    $this->validate($request, [
                        'title' => 'required|max:255',
                        'mytext' => 'required',
                        'u_id' => 'required|integer',
                        'post_id' => 'required|integer',
                    ]);

                    DB::table('posts')
                        ->where('p_id', $_POST['post_id'])
                        ->update(['title' => $_POST['title'] , 'mytext' => $_POST['mytext'] ,'updated_at' => date('Y-m-d    h:m')  ] );
                    return Redirect::to('/posts/edit/'.$_POST['post_id']);    
                }
                else{
                    return Redirect::to('/home');
                }
            } 
            else{
                return Redirect::to('/home');
            } 
        
            
        
    }



    public function insert(Request $request)
    {

    	$this->validate($request, [
	        'title' => 'required|unique:posts|max:255',
	        'mytext' => 'required',
	        'u_id' => 'required|integer',
	    ]);
	    DB::table('posts')->insert(
		    ['title' => $_POST['title'], 'mytext' => $_POST['mytext'] , 'u_id' => $_POST['u_id'] ,'created_at' => date('Y-m-d    h:m') ,'updated_at' => date('Y-m-d    h:m') ]
		);

		return Redirect::to('/home')->with('message', 'New Article Created');

    	//echo $_POST['title'];
    	
        //return view('articles.create');    
        
    }


    public function delete($id)
    {
        //echo "aaaaaaaaaa";
        $article= DB::table('posts')
            ->where('p_id', $id)->get();
            if(count($article) > 0){
                    DB::table('comments')->where('post_id', '=', $id)->delete();
                    DB::table('posts')->where('p_id', '=', $id)->delete();
                    return Redirect::to('/home');

            } 
            else{
                return Redirect::to('/home');
            } 
           
        
    }


}
