<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile); //toggle is used to attach or detach relationship connection, when a user hits follow or unfollow a profile
    }
}
