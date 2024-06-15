@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen flex-col justify-center px-6 py-12 lg:px-8 bg-gray-800">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="self-center text-5xl text-center font-bold whitespace-nowrap text-white">Flowblog</div>

            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-white">Sign in to your account</h2>
        </div>

        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('signin.post') }}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-white">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" required
                            class="block w-full rounded-md border-0 py-2 text-gray-900  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-white">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" required
                            class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset  ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-700/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Sign
                        in</button>
                </div>
            </form>

            <p class="mt-10 h-8 text-center text-sm text-white/90">
                Not a member?
                <a href="{{ route('signup') }}"
                    class="font-semibold leading-6 text-blue-600 hover:text-lg hover:font-bold transition-all duration-200">Sign
                    up</a>
            </p>
        </div>
    </div>
@endsection