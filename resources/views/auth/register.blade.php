<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Create your Account') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="name">{{ __('Nama Lengkap') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
            </div>

            <div>
                <x-label for="email">{{ __('Email') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label>{{ __('Pilih Kelas') }} <span class="text-rose-500">*</span></x-label>
                <div class="mt-2 space-y-2">
                    <label class="flex items-center">
                        <input type="radio" name="kelas" value="kelas 7" required>
                        <span class="ml-2">{{ __('Kelas 7') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="kelas" value="kelas 8" required>
                        <span class="ml-2">{{ __('Kelas 8') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="kelas" value="kelas 9" required>
                        <span class="ml-2">{{ __('Kelas 9') }}</span>
                    </label>
                </div>
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Konfirmasi Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>
        </div>
        <div class="flex items-center justify-center mt-6">
            <x-button>
                {{ __('Sign Up') }}
            </x-button>
        </div>
    </form>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200 dark:border-slate-700">
        <div class="text-sm">
            {{ __('Have an account?') }} <a
                class="font-medium text-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400"
                href="{{ route('login') }}">{{ __('Sign In') }}</a>
        </div>
    </div>
</x-authentication-layout>
