@extends('layouts.app')

@section('content')
    <x-navbar />

    <div class="bg-gray-800 h-screen flex flex-col justify-center items-center">
        <form class=" p-20 w-[50rem]" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 lg:grid-cols-2 ">


                <div class="flex items-center justify-center gap-8">

                    @if ($user->picture)
                        <img src="{{ asset('storage/' . $user->picture) }}" alt="Current Profile Picture"
                            class="rounded-full w-32 h-32 object-cover">
                    @else
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png"
                            alt="" class="rounded-full w-32 h-32 object-cover">
                    @endif
                    <div>
                        <h1 class="text-white text-lg">Name: {{ $user->name }}</h1>
                        <h1 class="text-white text-lg">Mail: {{ $user->email }}</h1>

                        <label
                            class="inline-block mt-4 border text-sm rounded-lg px-4 block  p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            for="picture">Upload
                            image...</label>
                        <input class="hidden" id="picture" name="picture" type="file">
                    </div>
                </div>

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                    <input type="text" id="name" name="name"
                        class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Someone's Name" value="{{ old('name', $user->name) }}" required autofocus />
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">
                        Email</label>
                    <input type="text" id="email" name="email"
                        class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="someone@example.com" value="{{ old('email', $user->email) }}" required>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-white">
                        Password</label>
                    <input type="text" id="password" name="password"
                        class="border text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter new password!" placeholder="Enter new password" minlength="8">
                </div>
            </div>
            <div class="mb-6">
                <div class="w-full mb-4 bg-gray-700 border border-gray-600 rounded-lg">
                    <div class="flex items-center justify-between px-3 py-2 border-b border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-600 sm:divide-x sm:rtl:divide-x-reverse">
                            <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                                {{-- <label for="image" class="p-2 rounded cursor-pointer text-white hover:bg-gray-600">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 16 20">
                                        <path
                                            d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                                    </svg>
                                    <input type="file" name="image" id="image" class="hidden">
                                    <span class="sr-only">Upload image</span>
                                </label> --}}

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
                    <div class="px-4 py-2 bg-gray-800 rounded-b-lg  ">
                        <label for="about" class="sr-only">Update</label>
                        <textarea id="about" name="about" rows="10"
                            class="block w-full px-0 text-sm text-white placeholder-gray-400 bg-gray-800 border-0 focus:ring-0"
                            placeholder="Write an article...">{{ old('about', $user->about) }}</textarea>

                    </div>
                </div>
            </div>


            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-900 hover:bg-blue-800">
                Update Profile
            </button>
        </form>
    </div>
@endsection
