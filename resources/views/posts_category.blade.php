@extends ('layouts.app')

@section('content')
<!-- Navbar -->
<x-navbar />

<!-- Content -->
<div class="flex flex-col items-center justify-center my-4">
    <h1
        class="pb4 block py-2 px-3 text-white bg-white-700 md:bg-transparent md:text-white-700 md:p-0 md:dark:text-white-500 border-b-2 border-blue-500 text-4xl font-bold uppercase ">
        {{ $name }}
    </h1>


    <div class="max-w-sm mx-auto">
        <select onchange="if (this.value) window.location.href=this.value"
            class="border rounded-lg bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
            <option value="?sort=desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Sort by Newest</option>
            <option value="?sort=asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Sort by Oldest</option>
        </select>
    </div>

    @foreach ($posts as $post)
        <div class="m-3 bg-white text-black rounded-lg shadow-lg overflow-hidden w-80">
            @if ($post->picture)
                <a href="/post/{{ $post->slug }}">
                    <div class="card-header">
                        <img class="w-full h-56 object-cover" src="{{ $post->picture }}" alt="{{ $post->title }}" />
                    </div>
                </a>
            @endif
            <div class="flex flex-col justify-center items-start px-5 min-h-64">
                <h4 class="py-2 mt-2 text-xl">{{ $post->title }}</h4>
                @foreach ($post->categories as $category)
                    <span class="text-[11px] m-0 rounded-md text-white py-1 px-2 cursor-pointer bg-[#47bcd4]">
                        {{ $category->name }}</span>
                @endforeach
                <div class="my-4 w-full border-b-[1px] border-gray-500">
                    <h4>{{ $post->short_description }}</h4>
                    <p class="text-sm mb-4">{{ $post->content }}</p>
                </div>
                <div class="flex my-1 justify-center items-center">
                    <img src="{{ \App\Models\User::find($post->user_id)->picture ? asset('storage/' . \App\Models\User::find($post->user_id)->picture) : 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png' }}"
                        alt="user" class="rounded-[50%] w-10 h-10 mr-3 object-cover" />
                    <div class="m-0">
                        <h5>{{ \App\Models\User::find($post->user_id)->name }}</h5>
                        <small class="text-[#545d7a]">
                            on
                            @if ($post->published_at)
                                {{ $post->published_at->format('d F Y H:i') }}
                            @else
                                <em>No published date</em>
                            @endif
                        </small>
                    </div>
                </div>
                @if (session('user_id') == $post->user_id)
                    <div class="flex justify-center my-4 w-full items-center">
                        <a href="{{ route('post.edit', $post->id) }}"
                            class="p-2 w-28 text-center bg-blue-500 text-white rounded mr-2">Edit</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 w-28 bg-red-500 text-white rounded">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <hr class="my-4" />
    @endforeach

    @if ($pagination_enabled)
        <div class="w-96 flex justify-center">
            @if ($posts->currentPage() > 1)
                <div class="flex justify-center">
                    <a href="?page={{ $posts->currentPage() - 1 }}&sort={{ request()->get('sort', 'desc') }}"
                        class="flex items-center justify-center px-4 h-10 w-40 me-3 text-base font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">
                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0 4 4M1 5l4-4" />
                        </svg>
                        Previous
                    </a>
                </div>
            @endif
            @if ($posts->count() > 4 || ($posts->count() <= 4 && $posts->hasMorePages()))
                <a href="?page={{ $posts->currentPage() + 1 }}&sort={{ request()->get('sort', 'desc') }}"
                    class="flex items-center justify-center px-4 h-10 w-40 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    Next
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            @endif
        </div>
    @endif
</div>
@endsection