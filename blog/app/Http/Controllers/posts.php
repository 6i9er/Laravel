<?php

namespace App\Http\Controllers;



/*use Illuminate\Http\Request;

use App\Http\Requests;*/


use DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\article;

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
    	echo $id;
        $article= DB::table('articles')
            ->where('id', $id)->get();
        //var_dump($article);


        if(count($article) > 0){
            //var_dump($articles);
            return view('articles/show' , ['article' => $article]);    
        }
        else{
            echo "No Data Found";
        }
    }

    public function create()
    {
    	
        return view('articles.create');    
        
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


}
