<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\article;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $articles= DB::table('posts')
            ->join('users', 'posts.u_id', '=', 'users.id')->get();
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
}
