<!-- resources/views/components/navbar.blade.php -->
<nav class="border-gray-200 bg-gray-800 border-b-[1px] border-white">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Flowblog</span>
        </a>

        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @if (@session('user_id'))
                <?php
                $user_id = session()->get('user_id');
                $query = 'SELECT name, email, picture, admin FROM users WHERE id = :user_id';
                $statement = app('db')->connection()->getPdo()->prepare($query);
                $statement->bindParam(':user_id', $user_id);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                ?>

                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full object-cover"
                        src="{{ $user['picture'] ? asset('storage/' . $user['picture']) : 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png' }}"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none divide-y rounded-lg shadow bg-gray-700 divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-white">{{ $user['name'] }}</span>
                        <span class="block text-sm truncate text-gray-400">{{ $user['email'] }}</span>
                        @if ($user['admin'])
                            <span class="block text-sm truncate text-gray-200">This account is administrator</span>
                        @endif
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <?php
                        $user_id = session()->get('user_id');
                        $query = 'SELECT name, email, admin FROM users WHERE id = :user_id';
                        $statement = app('db')->connection()->getPdo()->prepare($query);
                        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                        $statement->execute();
                        $user = $statement->fetch(PDO::FETCH_ASSOC);
                        
                        if ($user && $user['admin']) {
                            echo '
                                                                                                                                                                                                                                                                        <li>
                                                                                                                                                                                                                                                                            <a href="/admin/users" class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Users Dashboard</a>
                                                                                                                                                                                                                                                                        </li>
                                                                                                                                                                                                                                                                        <li>
                                                                                                                                                                                                                                                                            <a href="/admin/posts" class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Posts Dashboard</a>
                                                                                                                                                                                                                                                                        </li>';
                        }
                        ?>
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Settings</a>
                        </li>
                        <!-- <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm  hover:bg-gray-600 text-gray-200 hover:text-white">Earnings</a>
                        </li> -->
                        <li>
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm hover:bg-gray-600 text-gray-200 hover:text-white">Sign
                                out</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            @else
                <a href="{{ route('signin') }}" class="block py-1 px-3 rounded-md bg-blue-700 text-white">Login</a>
            @endif
        </div>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-gray-800">
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'block py-2 px-3 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 border-b-2 border-blue-500' : 'block py-2 px-3 rounded md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('post.create') }}"
                        class="{{ request()->routeIs('post.create') ? 'block py-2 px-3 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 border-b-2 border-blue-500' : 'block py-2 px-3 rounded md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700' }}">Post</a>
                </li>
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('news') ? 'block py-2 px-3 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 border-b-2 border-blue-500' : 'block py-2 px-3 rounded md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700' }}">News</a>
                </li>
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('about') ? 'block py-2 px-3 text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 border-b-2 border-blue-500' : 'block py-2 px-3 rounded md:p-0 text-white md:hover:text-blue-500 hover:bg-gray-700 hover:text-white md:hover:bg-transparent border-gray-700' }}">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
