<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = User::where('username',$request->user()->username)->orWhere('id',$request->user()->id)->firstOrFail();

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

    public function edit($user){
        $user = User::where('username',$user)->first();
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the given profile.
     *
     * @param User $user
     * @param ImageControler $image
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(User $user, ImageController $photo){
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; //regrex rules for replacing https:// to be more friendly url
        $data = request()->validate([
            'title' =>'required|max:128',
            'description' => 'required',
            'link' =>  'nullable|regex:' .$regex,
            
        ]);
        
        if(request()->hasFile('image')):
            $imgPath = $photo->uploadtoS3(request()->file('image'));
            auth()->user()->profile()->update( array_merge($data,$imgPath ?? []) );
        endif;

        return redirect("/profile/".auth()->user()->username);
    }
}
