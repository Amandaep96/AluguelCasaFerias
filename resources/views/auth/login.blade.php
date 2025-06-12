<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-white-900 border-gray-300 dark:border-dark-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Separando reCAPTCHA e botões -->
        <div class="mt-4">
            <!-- reCAPTCHA alinhado à esquerda -->
            <div class="flex justify-start">
                <div class="g-recaptcha" data-sitekey="{{ config('services.google.recaptcha_site_key') }}"></div>
            </div>
            @error('g-recaptcha-response')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <!-- Forgot Password & Login Button mantidos à direita -->
            <div class="flex items-center justify-end w-full mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-dark-600 dark:text-dark-400 hover:text-black-500 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Esqueceu a tua senha?') }}
                    </a>
                @endif

                <!-- Botão de Registro -->
                <a href="{{ route('register') }}"
                    class="ms-3 underline text-sm text-dark-600 dark:text-dark-400 hover:text-black-500 dark:hover:text-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Regista-te') }}
                </a>

                <x-primary-button class="ms-3">
                    {{ __('Iniciar sessão') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>
