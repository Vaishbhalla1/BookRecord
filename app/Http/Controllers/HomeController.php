<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->take(6)->published()->get();
        return view('index', compact('posts'));
    }
    public function posts()
    {
        $categories = Category::all();
        $posts = Post::latest()->published()->paginate(10);
        return view('posts', compact('posts', 'categories'));
    }
    public function post($slug)
    {
        $categories = Category::all();
        $post = Post::where('slug', $slug)->published()->first();
         $postKey = 'post_'.$post->id;
        if(!Session::has($postKey)){
            $post->increment('view_count');
            Session::put($postKey, 1);
        }

        return view('post', compact('post','categories'));
    }
    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }
    public function categoryPost($slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->published()->paginate(10);

        return view('categoryPost', compact('posts', 'categories'));
    }
    public function search(Request $request)
    {
        $this->validate($request, ['search' => 'required|max:255']);
        $search = $request->search;
        $posts = Post::where('title', 'like', "%$search%")->paginate(10);
        $posts->appends(['search' => $search]);

        // $categories = Category::all();
        return view('search', compact('posts', 'search'));
    }
    public function tagPosts($name)
    {
        $query = $name;
        $tags = Tag::where('name', 'like', "%$name%")->paginate(10);
        $tags->appends(['search' => $name]);

        return view('tagPosts', compact('tags', 'query'));
    }
    public function likePost($post){
        // Check if user already liked the post or not
        $user = Auth::user();
        $likePost = $user->likedPosts()->where('post_id', $post)->count();
        if($likePost == 0){
            $user->likedPosts()->attach($post);
        } else{
            $user->likedPosts()->detach($post);
        }
        return redirect()->back();
    }
}
