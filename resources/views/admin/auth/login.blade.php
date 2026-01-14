<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">Login User</h1>
        <p class="text-sm text-gray-500">Masuk ke sistem antrian pasien</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember -->
        <div class="mt-4 flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('password.request') }}">
                Lupa password?
            </a>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                Login
            </x-primary-button>
        </div>

        <div class="mt-4 text-center text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                Register
            </a>
        </div>
    </form>
</x-guest-layout>