<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label value="Nom & prénom" />
                <x-jet-input class="block mt-1 w-full" type="text" dusk="name" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Téléphone" />
                <x-jet-input class="block mt-1 w-full" type="text" dusk="phone" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Email" />
                <x-jet-input class="block mt-1 w-full" type="email" dusk="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="Mot de passe" />
                <x-jet-input class="block mt-1 w-full" type="password" dusk="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="Confirmation du mot de passe" />
                <x-jet-input class="block mt-1 w-full" type="password" dusk="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>

                <x-jet-button class="ml-4" dusk="submit">
                    M'inscrire
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
