@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    <article class="mb-4 mt-12"> <!-- Dodan mt-12 za razmak od navbara -->
        <div class="container mx-auto px-4 px-lg-5">
            <div class="flex justify-center">
                <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2">
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <div class="text-center mb-6">
                            <h1 class="text-4xl font-bold">{{ $post->title }}</h1>
                            <h2 class="subheading text-2xl text-gray-500">{{ $post->description }}</h2>
                        </div>
                        @if ($post->picture)
                            <div class="flex justify-center mb-6">
                                <img class="w-52 h-52 object-cover rounded-lg" src="{{ $post->picture }}"
                                    alt="Image not found {{ $post->title }}">
                            </div>
                        @endif
                        <div class="flex flex-col items-start">
                            <div class="text-sm text-gray-600 mb-4">{{ $post->short_description }}</div>
                            <div class="w-full border-b-[1px] border-gray-300 mb-4"></div>
                            <div class="prose prose-sm mb-4">
                                {!! $post->content !!}
                            </div>
                            <div class="flex items-center mt-4">
                                <img src="https://placehold.co/400" alt="user" class="rounded-full w-10 h-10 mr-3">
                                <div>
                                    <h5 class="text-sm font-medium">{{ \App\Models\User::find($post->user_id)->name }}</h5>
                                    <small class="text-gray-500">on
                                        {{ date('m d, y', strtotime($post->published_at)) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
