<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\User;
use App\Posts;

class HomeController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')->paginate(6);
        //dd($posts);
        if($posts->currentPage() > $posts->lastPage()) return redirect()->route('welcome');
        return view('welcome', compact('posts'));
    }
}
