<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-r flex items-center justify-center">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden w-full max-w-5xl flex flex-col md:flex-row">
            <!-- Partie gauche (welcome) -->
            <div class="hidden md:flex flex-col justify-center items-center text-white bg-gradient-to-br from-red-600 to-red-800 w-full md:w-1/2 p-10">
                <h2 class="text-3xl font-bold mb-4">VÉRIFICATION</h2>
                <p class="text-sm text-center mb-6">Merci pour votre inscription à TaskMaster</p>
                <p class="text-xs opacity-80">Veuillez vérifier votre adresse email pour continuer</p>
            </div>

            <!-- Partie droite (contenu) -->
            <div class="w-full md:w-1/2 p-8 sm:p-12">
                <h2 class="text-2xl font-extrabold text-red-600 mb-2 text-center">Vérification requise</h2>
                
                <div class="mb-4 text-sm text-gray-600 text-center">
                    {{ __('Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer. Si vous n\'avez pas reçu l\'email, nous vous en enverrons un autre avec plaisir.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse email que vous avez fournie lors de l\'inscription.') }}
                    </div>
                @endif

                <div class="mt-6 space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            {{ __('Renvoyer l\'email de vérification') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="text-center">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-500">
                            {{ __('Se déconnecter') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>