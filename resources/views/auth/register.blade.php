<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">
            <!-- Partie gauche (welcome) -->
            <div class="hidden md:flex flex-col justify-center items-center text-white bg-gradient-to-br from-red-600 to-red-800 w-full md:w-1/2 p-10">
                <h2 class="text-3xl font-bold mb-4">WELCOME</h2>
                <p class="text-sm text-center mb-6">Votre solution pour organiser, suivre et réussir vos tâches au quotidien avec <strong>TaskMaster</strong>.</p>
                <p class="text-xs opacity-80">Créez un compte pour commencer</p>
            </div>

            <!-- Partie droite (formulaire) -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <h2 class="text-2xl font-extrabold text-red-600 mb-2 text-center">Créer un compte</h2>
                <p class="text-sm text-gray-500 mb-6 text-center">Rejoignez TaskMaster et commencez à gérer vos tâches facilement</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nom complet')" class="block text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input id="name" 
                                        class="block w-full pl-10 py-3 border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500" 
                                        type="text" 
                                        name="name" 
                                        :value="old('name')" 
                                        required 
                                        autofocus 
                                        autocomplete="name" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

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
                                        autocomplete="email" />
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
                                        autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="block text-sm font-medium text-gray-700" />
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input id="password_confirmation" 
                                        class="block w-full pl-10 py-3 border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500"
                                        type="password"
                                        name="password_confirmation" 
                                        required 
                                        autocomplete="new-password" />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-red-600 hover:text-red-500">
                            Déjà inscrit ?
                        </a>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
