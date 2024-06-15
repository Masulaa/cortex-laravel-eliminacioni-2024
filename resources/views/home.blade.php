@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    <x-navbar />

    <!-- Content -->
    @php
        $pagination_enabled = true;
    @endphp


    @if ($posts->total() > 0)
        @include('post_list')
    @else
        <div class="flex flex-col items-center justify-center mt-8 ">


            <div
                class="  bg-gray-700 border-gray-600 border-2 rounded-lg w-96 h-32 p-4 flex flex-col items-center justify-center">
                <div class="text-white  text-3xl ">
                    There are no Posts.
                </div>
                <a href="{{ route('post.create') }}" class="text-blue-500 font-semibold  text-2xl underline">Be first to
                    post!!!</a>
            </div>
        </div>
    @endif
@endsection
