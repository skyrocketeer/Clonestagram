<?php

namespace App\Http\Controllers\Api;

use App\Exceptions as Exception;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('client_credentials');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd($this->middleware instanceof CheckClientCredentials);
        //get all posts of the current user
        $user = auth('api')->user();
        dd($user);
        $posts = Post::whereIn('user_id',$user)->latest()->get();

        //return collection of posts as a resource
        return new PostCollection($posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get single post
        $post = Post::find($id);

        if($post):
            //return single post
            return new PostResource($post);
        else:
            return response()->json(['errorMessage' => 'resource not found'], 404);
        endif;  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {   
        $post = $request->validated();
        
        try {
            $post = Post::create([
                'user_id' => $request->user()->id,
                'caption' => $request->caption,
                'image' => isset($request->image)? $request->image : '', 
            ]);
            return response()->json(['message'=>'New record created successfully'],200);
        } catch(Exception $e){
            if($e instanceof Exception):
                return response()->json(['message'=>'Fail to create new record'],400);
            endif;  
        }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if($post):
            $post->caption = $request->caption;
            $post->image = isset($request->image)? $request->image : null;
            $post->update($request->all());
            return response()->json(['message' => 'Updated successfully'], 200);
        else:
            return response()->json(['errorMessage' => 'Resource not found'], 404); 
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
