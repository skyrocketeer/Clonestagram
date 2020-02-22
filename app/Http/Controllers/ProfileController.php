<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    public function index(Request $request){
        $user = User::where('id',$request->user()->id)->firstOrFail();

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

    public function edit(){
        $user = User::where('id',request()->user()->id)->firstOrFail();
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
    public function update(ImageController $photo){
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; //regrex rules for replacing https:// to be more friendly url
        $data = request()->validate([
            'title' =>'required|max:128',
            'description' => 'required',
            'link' =>  'nullable|regex:' .$regex,
        ]);
        
        dd($data);
        if(request()->hasFile('image')):
            $rules = [ 'image' => 'mimes:jpg,jpeg,png,max:2048' ]; 
            $validator = Validator::make(request()->only('image'), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors(['image' => 'invalid file type or exceed limit 2MB']);
            }

            $photo->upload();
            $imgPath = $photo->getImgPath();
            
            if(is_null($imgPath)):
                auth()->user()->profile()->update($data);
            else:
            $imgArr = ['image' => $imgPath];        
            auth()->user()->profile()->update( array_merge($data,$imgArr ?? []) );
            endif;

        else: auth()->user()->profile()->update($data);
        auth()->user()->profile()->update($data);
        endif;

        return redirect("/profile/".auth()->user()->username);
    }
}
