@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" id="slug" name="slug" value="{{ $post->slug }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description:</label>
                    <textarea id="short_description" name="short_description" class="form-control" required>{{ $post->short_description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" class="form-control" required>{{ $post->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="picture">Picture:</label>
                    <input type="file" id="picture" name="picture" class="form-control-file">
                    @if($post->picture)
                        <img src="{{ Storage::url($post->picture) }}" alt="Current Picture" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="published_at">Published At:</label>
                    @if(!empty($post->published_at) && $post->published_at instanceof \DateTime)
    <input type="datetime-local" id="published_at" name="published_at" value="{{ $post->published_at->format('Y-m-d\TH:i') }}" class="form-control">
@else
    <input type="datetime-local" id="published_at" name="published_at" class="form-control">
@endif
                </div>

                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </div>
    </div>
@stop
