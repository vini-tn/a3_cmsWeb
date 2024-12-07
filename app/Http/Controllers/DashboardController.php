<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //This function is display the posts from the database. It contains paginate where it'd display 6 posts per slide. This is activated when there are more than 6 posts in the database. This is called in the web routes for dashboard view.
    public function index(){
        $posts = Auth::user()->posts()->latest()->paginate(6);
        return view('users.dashboard', ['posts'=>$posts]);
    }

    //This function is to display the clicked user's posts using paginate. This is used in posts view. This is called in the web routes for posts view.
    public function userPosts(User $user){
        $userPosts = $user->posts()->latest()->paginate(6);
        return view('users.posts',[
            'posts'=>$userPosts,
            'user'=>$user
        ]);
    }
}
