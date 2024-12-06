<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            
            // new Middleware('auth', only: ['store']),
            new Middleware('auth', except: ['index','show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::latest()->paginate(6);
       
         return view('posts.index',['posts' =>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate 
         $request->validate([
            'title'=>['required','max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:5000','mimes:png,jpg,webp']

        ]);

// store image if exists

            $path = null;

        if ($request->hasFile('image')) {
           $path = Storage::disk('public')->put('post_images', $request->image);
        }

        //create a post

        Auth::user()->posts()->create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);

        //redirect to dashboard
       return back()->with('success',"Your post was created");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post' =>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify',$post);
        return view('posts.edit',['post' =>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //validate 
         $request->validate([
            'title'=>['required','max:255'],
            'body'=>['required'],
            'image'=>['nullable','file','max:5000','mimes:png,jpg,webp']

        ]);

     

        if ($request->hasFile('image')) {

            // Delete the old image from storage if it exists

            if ($post->image) {
                //delete the old image based on the path stored in the database
                Storage::disk('public')->delete($post->image);
            }
            //store the new image and get the path
            $path = $request->file('image')->store('post_images','public');

        }else{
            //if no new image is uploaded , keep the current image path
                $path = $post->image;
          
        }

        

         // update the post
         $post->update([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$path
        ]);


      

        // redirect back to dashboard
        return redirect()->route('dashboard')->with('success','Your post was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {


        // Authorizing the action
        Gate::authorize('modify',$post);

        //Delete post image if exists
        if($post->image){
            Storage::disk('public')->delete($post->image);  
        }
        // delete the post
        $post->delete();

        // redirect back to dashboard

        return back()->with('delete','Your post was deleted!');

    }
}
