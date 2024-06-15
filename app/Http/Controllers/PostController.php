<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort', 'desc');

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $posts = Post::orderBy('created_at', $sortOrder)->paginate(4);

        $posts->appends(['sort' => $sortOrder]);

        return view('home', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post', ["post" => $post]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('new_post', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'slug' => 'required|unique:posts,slug',
            'content' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add this line for image validation
            'category_id' => 'required|exists:categories,id',
        ]);


        $user_id = $request->session()->get('user_id');

        if ($user_id) {
            $imageURL = null;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imageURL = url('images/' . $imageName);
            }

            $post = new Post;
            $post->title = $request->title;
            $post->short_description = $request->short_description;
            $post->slug = Str::slug($request->slug);
            $post->content = $request->content;
            $post->user_id = $user_id;
            $post->picture = $imageURL;
            $post->published_at = Carbon::now();
            $post->save();

            $post->categories()->attach($request->category_id);

            return redirect()->route('home')->with('success', 'Post created successfully');
        } else {
            abort(403, 'Unauthorized action.');
        }
    }


    public function edit(Request $request, Post $post)
    {
        $user_id = $request->session()->get('user_id');
        if ($post->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('edit_post', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $user_id = $request->session()->get('user_id');
        if ($post->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'content' => 'required',
        ]);

        $post->title = $request->title;
        $post->short_description = $request->short_description;
        $post->slug = Str::slug($request->slug);
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $post->picture = url('images/' . $imageName);
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Post updated successfully');
    }

    public function destroy(Request $request, Post $post)
    {
        $user_id = $request->session()->get('user_id');
        if ($post->user_id != $user_id) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully');
    }

}
