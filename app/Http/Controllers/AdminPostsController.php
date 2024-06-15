<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class AdminPostsController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->checkAdmin($request);

        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function create(Request $request)
    {
        $user = $this->checkAdmin($request);

        return view('admin.posts');
    }

    public function store(Request $request)
    {
        $user = $this->checkAdmin($request);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug',
            'short_description' => 'required|string',
            'content' => 'required|string',
            'picture' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $post = new Post($request->all());

        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('public/posts');
            $post->picture = $picturePath;
        }

        $post->save();

        return redirect()->route('admin.posts')->with('success', 'Post created successfully');
    }

    public function show(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $post = Post::findOrFail($id);
        return view('admin.posts', compact('post'));
    }

    public function edit(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $post = Post::findOrFail($id);
        return view('admin.posts-edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:posts,slug,' . $post->id,
            'short_description' => 'required|string',
            'content' => 'required|string',
            'picture' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $post->update($request->all());

        if ($request->hasFile('picture')) {
            if ($request->hasFile('picture')) {
                $picture = $request->file('picture');
                $pictureName = time() . '.' . $picture->getClientOriginalExtension();
                $picture->move(public_path('images'), $pictureName);
                $pictureURL = url('images/' . $pictureName);
                $post->picture = $pictureURL;
            }
            $post->save();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
    }

    protected function checkAdmin(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);

        if (!$user || !$user->admin) {
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }
}
