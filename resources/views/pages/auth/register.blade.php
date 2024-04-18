<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-3xl">
        <div class="p-4 bg-white rounded-md">
            <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Tambah Akun Guru') }} ✨</h1>
            <form method="POST" action="{{ route('admin.create') }}">
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
                        {{ __('Buat Akun') }}
                    </x-button>
                </div>
            </form>
            <x-validation-errors class="mt-4" />
        </div>
    </section>

    @if (session('success'))
        <script>
            swal.fire({
                title: 'Sukses',
                icon: 'success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb',
            });
        </script>
    @endif
</x-app-layout>
