<nav class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
    <h1 class="text-2xl font-bold text-red-600">TaskMaster</h1>

    <div class="flex-2 text-center">
        <p class="text-lg font-semibold text-gray-700 text-type">
            Karibou sur TaskMaster !
        </p>
    </div>

    <ul class="flex items-center gap-4">
        <li>
            <header class="text-sm">
                @if (Route::has('login'))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-800 hover:border-red-500 hover:bg-red-500 hover:text-white transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="border border-red-600 hover:bg-red-50 text-red-600 font-semibold py-3 px-6 rounded-lg transition">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
        </li>
    </ul>
</nav>
