<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        dd('main controller');
        $users = auth()->user()->following()->pluck('profiles.user_id');
        
        $posts = Post::whereIn('user_id', $users)->latest()->paginate(4);
        
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
        ]);

        $imagePath =  request()->file('image')->store('uploads','public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        return redirect('profile/' .auth()->user()->username);
    }

    public function show(Post $post){
        return view('posts.show', compact('post')); // = view('post.show', ['post'=>$post])
    }

    public function destroy(Post $post){
        auth()->user()->posts()->first()->delete();
        return redirect('profile/' .auth()->user()->username);
    }
}
