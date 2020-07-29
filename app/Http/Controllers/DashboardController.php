<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Posts;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = DB::table('posts')->orderBy('id', 'DESC')->paginate(50);
        if($posts->currentPage() > $posts->lastPage()) return redirect()->route('dashboard.index');
        return view('dashboard.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required'
        ]);
  
        Posts::create([
            'users_id' => $request->users_id,
    		'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $request->thumbnail
    	]);
   
        return redirect()
            ->route('dashboard.index')
            ->with('success', 'Artikel berhasil di buat.');
    }
    
    public function show()
    {
        return redirect()->route('dashboard.index');
    }

    public function edit($id)
    {
        if(Auth::user()->roles == 1) {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->first();
        } else {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->where('users_id', '=', Auth::user()->id)
            ->first();
        }
        if(is_null($post)) return redirect()->route('dashboard.index');
        return view('dashboard.edit', compact('post'));
    }
  
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'required'
        ]);

        $post = Posts::find($id);
        $post->title =  $request->get('title');
        $post->content = $request->get('content');
        $post->thumbnail = $request->get('thumbnail');
        $post->save();

        return redirect()
            ->route('dashboard.index')
            ->with('success', 'Artikel berhasil di update.');
    }
  
    public function destroy($id)
    {
        if(Auth::user()->roles == 1) {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->delete();
        } else {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->where('users_id', '=', Auth::user()->id)
            ->delete();
        }
        return redirect()
            ->route('dashboard.index')
            ->with('success', 'Artikel berhasil di hapus.');
    }

    public function pord($id)
    {
        if(Auth::user()->roles == 1) {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->first();
        } else {
            $post = DB::table('posts')
            ->where('id', '=', $id)
            ->where('users_id', '=', Auth::user()->id)
            ->first();
        }
        if(is_null($post)) return redirect()->route('dashboard.index');
        $pord = Posts::find($id);
        if($post->status == 1) {
            $pord->status = 0;
            $status = 'Artikel berhasil di draft';
        } else {
            $pord->status = 1;
            $status = 'Artikel berhasil di publish';
        }
        $pord->save();

        return redirect()
            ->route('dashboard.index')
            ->with('success', $status);
    }
}
