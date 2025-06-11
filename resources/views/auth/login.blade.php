<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">
            <!-- Partie gauche (welcome) -->
            <div class="hidden md:flex flex-col justify-center items-center text-white bg-gradient-to-br from-red-600 to-red-800 w-full md:w-1/2 p-10">
                <h2 class="text-3xl font-bold mb-4">WELCOME BACK</h2>
                <p class="text-sm text-center mb-6">Reconnectez-vous à votre espace <strong>TaskMaster</strong> pour gérer vos tâches quotidiennes.</p>
                <p class="text-xs opacity-80">Pas encore de compte ? Créez-en un maintenant</p>
            </div>

            <!-- Partie droite (formulaire) -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <h2 class="text-2xl font-extrabold text-red-600 mb-2 text-center">Se connecter</h2>
                <p class="text-sm text-gray-500 mb-6 text-center">Accédez à votre compte TaskMaster</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Adresse email')" class="block text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input id="email" 
                                        class="block w-full pl-10 py-3 border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500" 
                                        type="email" 
                                        name="email" 
                                        :value="old('email')" 
                                        required 
                                        autofocus 
                                        autocomplete="username" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Mot de passe')" class="block text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input id="password" 
                                        class="block w-full pl-10 py-3 border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
                                        type="password"
                                        name="password"
                                        required 
                                        autocomplete="current-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-500 shadow-sm focus:ring-red-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-red-600 hover:text-red-500">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            {{ __('Se connecter') }}
                        </button>
                    </div>

                    <div class="text-center text-sm text-gray-500">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-500">
                            S'inscrire
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>