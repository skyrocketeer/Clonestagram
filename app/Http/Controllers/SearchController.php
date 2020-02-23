<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    /**
    * Search for a profile.
    *
    * @param  Request  $request
    * @return Response
    */
    public function search(){
        $query = request()->validate(['q' => 'nullable|regex:^[a-zA-Z0-9]^']);
        $users = User::where('username','like','%'.$query['q'].'%')->get();
        
        if(count($users) > 0):
            $users = $users->load('profile');
            return view('search.index', [ "query" => $query['q'] ])->with('users', $users);
        else: 
            return view('search.index')->withMessage('Oops! No data found. Try to search again !');
        endif;
    }
}
