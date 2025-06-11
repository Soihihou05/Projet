<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">
            <!-- Partie gauche (welcome) -->
            <div class="hidden md:flex flex-col justify-center items-center text-white bg-gradient-to-br from-red-600 to-red-800 w-full md:w-1/2 p-10">
                <h2 class="text-3xl font-bold mb-4">RÉINITIALISATION</h2>
                <p class="text-sm text-center mb-6">Vous avez oublié votre mot de passe ? Pas de problème. Nous vous enverrons un lien de réinitialisation.</p>
                <p class="text-xs opacity-80">TaskMaster - Gestion simplifiée de vos tâches</p>
            </div>

            <!-- Partie droite (formulaire) -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <h2 class="text-2xl font-extrabold text-red-600 mb-2 text-center">Réinitialiser le mot de passe</h2>
                <p class="text-sm text-gray-500 mb-6 text-center">
                    {{ __('Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                                        autocomplete="email" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-red-600 hover:text-red-500">
                            Retour à la connexion
                        </a>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            {{ __('Envoyer le lien de réinitialisation') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>