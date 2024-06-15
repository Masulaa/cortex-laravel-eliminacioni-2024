@extends('layouts.app')

@section('content')
    <x-navbar />

    <div class="bg-gray-800 h-screen flex flex-col justify-center items-center">

        <form class=" p-20 w-[50rem]" method="POST" action="{{ route('post.update', $post->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-6 mb-6 lg:grid-cols-2 ">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-white">Title</label>
                    <input type="text" id="title" name="title"
                        class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Blog Post" value="{{ $post->title }}" required />
                </div>
                <div>
                    <label for="short_description" class="block mb-2 text-sm font-medium text-white">Short
                        Description</label>
                    <input type="text" id="short_description" name="short_description"
                        class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Lorem ipsum" value="{{ $post->short_description }}" required />
                </div>
            </div>
            <div class="mb-6">
                <label for="slug" class="block mb-2 text-sm font-medium text-white">Slug</label>
                <input type="text" id="slug" name="slug"
                    class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                    placeholder="SLug?" value="{{ $post->slug }}" required />
            </div>
            <div class="mb-6">
                <div class="w-full mb-4 bg-gray-700 border border-gray-600 rounded-lg">
                    <div class="flex items-center justify-between px-3 py-2 border-b border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-600 sm:divide-x sm:rtl:divide-x-reverse">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                                <label for="image" class="p-2 rounded cursor-pointer text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                    </svg>
                                    <input type="file" name="image" id="image" class="hidden">
                                    <span class="sr-only">Upload image</span>
                                </label>

                                <button type="button"
                                    class="p-2 text-gray-400 rounded cursor-pointer hover:text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 12 20">
                                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                            d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                    </svg>
                                    <span class="sr-only">Attach file</span>
                                </button>
                                <button type="button"
                                    class="p-2 text-gray-400 rounded cursor-pointer hover:text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                    <span class="sr-only">Embed map</span>
                                </button>


                                <button type="button"
                                    class="p-2 text-gray-400 rounded cursor-pointer hover:text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 20">
                                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                        <path
                                            d="M14.067 0H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.933-2ZM6.709 13.809a1 1 0 1 1-1.418 1.409l-2-2.013a1 1 0 0 1 0-1.412l2-2a1 1 0 0 1 1.414 1.414L5.412 12.5l1.297 1.309Zm6-.6-2 2.013a1 1 0 1 1-1.418-1.409l1.3-1.307-1.295-1.295a1 1 0 0 1 1.414-1.414l2 2a1 1 0 0 1-.001 1.408v.004Z" />
                                    </svg>
                                    <span class="sr-only">Format code</span>
                                </button>
                                <button type="button"
                                    class="p-2 text-gray-400 rounded cursor-pointer hover:text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM13.5 6a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm-7 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm3.5 9.5A5.5 5.5 0 0 1 4.6 11h10.81A5.5 5.5 0 0 1 10 15.5Z" />
                                    </svg>
                                    <span class="sr-only">Add emoji</span>
                                </button>
                            </div>
                        </div>
                        <button type="button" data-tooltip-target="tooltip-fullscreen"
                            class="p-2 text-gray-400 rounded cursor-pointer sm:ms-auto hover:text-white hover:bg-gray-600">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 19 19">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 1h5m0 0v5m0-5-5 5M1.979 6V1H7m0 16.042H1.979V12M18 12v5.042h-5M13 12l5 5M2 1l5 5m0 6-5 5" />
                            </svg>
                            <span class="sr-only">Full screen</span>
                        </button>
                        <div id="tooltip-fullscreen" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip">
                            Show full screen
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-gray-800 rounded-b-lg">
                        <label for="content" class="sr-only">Publish post</label>
                        <textarea id="content" name="content" rows="8"
                            class="block w-full px-0 text-sm text-white placeholder-gray-400 bg-gray-800 border-0 focus:ring-0"
                            placeholder="Write an article..." required>{{ $post->content }}</textarea>
                        <div id="image-preview" class="flex items-center justify-center w-full h-40 ">
                            @if ($post->picture)
                                <img id="preview-img" src="{{ $post->picture }}" alt="{{ $post->title }}"
                                    class="img-fluid mt-2" width="150">
                            @else
                                <img id="preview-img" src="#" alt="Image Preview" class="hidden img-fluid mt-2"
                                    width="150">
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-900 hover:bg-blue-800">
                Publish post
            </button>
        </form>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('preview-img');
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
