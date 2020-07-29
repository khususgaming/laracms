<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use App\Posts;

class PostController extends Controller
{
    public function index()
    {
        return redirect('/');
    }
    
    public function view($id)
    {
        $post = DB::table('posts')
        ->where('id', '=', $id)
        ->where('status', '=', 1)
        ->first();
        if(is_null($post)) return redirect()->route('welcome');
        return view('post', compact('post'));
    }
}
