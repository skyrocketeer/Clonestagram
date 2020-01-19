<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function index($user){
        $user = User::where('username',$user)->orWhere('id',$user)->firstOrFail();

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
                'count.posts.'. $user->id, 
                now()->addSeconds(30), 
                function () use ($user){
                    return $user->posts()->count();
                }
            );
        
        $followersCount = Cache::remember(
            'count.followers.'. $user->id, 
            now()->addSeconds(30), 
            function () use ($user){
                return $user->profile->followers()->count();
            }
        );
            
        $followingCount = Cache::remember(
            'count.followers.'. $user->id, 
            now()->addSeconds(30), 
            function () use ($user){
                $user->following()->count();  
            }
        );
         
        return view('profiles.index',compact('user','follows','postCount', 'followersCount', 'followingCount'));
    }

    /**
     * Update the given profile.
     *
     * @param  User  $user
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($user){
        $user = User::where('username',$user)->orWhere('id',$user)->first();
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; //regrex rules for replacing https:// to be more friendly url
        $data = request()->validate([
            'title' =>'required|max:128',
            'description' => 'required',
            'link' =>  'nullable|regex:' .$regex,
            'image' => '',
        ]);
        
        if(request()->file('image')):
            $imgPath = request()->file('image')->store('profile','public');
            $imgArr = ['image' => $imgPath];
        endif;

        auth()->user()->profile()->update( array_merge($data,$imgArr ?? []) );

        return redirect("/profile/".auth()->user()->username);
    }
}
