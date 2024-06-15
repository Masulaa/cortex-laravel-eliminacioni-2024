@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Posts</h3>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Content</th>
                        <th>Picture</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->short_description }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->picture }}</td>
                            <td>{{ $post->published_at }}</td>
                            <td>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
<a href="{{ route('post.show', ['post' => $post->slug]) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Post</h3>
        </div>
        <div class="card-body">


    <div class="card-body">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Blog Post" required>
            </div>

            <div class="form-group">
                <label for="short_description">Short Description</label>
                <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Lorem ipsum" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug?" required>
            </div>

            <div class="form-group">
                <label for="image">Upload image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" class="form-control" name="content" rows="8" placeholder="Write an article..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Publish post</button>
        </form>
    </div>

        </div>
    </div>
@endsection
