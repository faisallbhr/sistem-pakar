<x-app-layout>
    <style>
        input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        input[type="radio"]:checked+label {
            background-color: rgb(59, 130, 246);
            color: white
        }
    </style>

    <section class="w-full max-w-4xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
        <div class="grid justify-center p-8 bg-white rounded-md shadow-md">
            <div class="space-y-2">
                <h2><span class="font-medium text-black">Dalam 2 minggu terakhir,</span>
                    seberapa sering
                    masalah-masalah
                    berikut
                    ini
                    mengganggumu?</h2>
                <p>Tidak semua field harus diisi, jadi pastikan untuk memberikan jawaban yang tepat sesuai dengan
                    pengalamanmu.</p>
            </div>
            <form action="{{ route('diagnosa.store') }}" method="POST" enctype='multipart/form-data' novalidate>
                @csrf
                <div class="my-8 space-y-12">
                    @foreach ($gejalas as $gejala)
                        <div class="space-y-3">
                            <h3>{{ $loop->iteration }} Apakah anda merasa
                                {{ $gejala->deskripsi }}?</h3>
                            <ul class="flex flex-wrap gap-6 md:ml-3">
                                @foreach ($kondisis as $kondisi)
                                    <li>
                                        <input type="radio" name="choice_{{ $gejala->kode }}"
                                            id="choice_{{ $gejala->kode }}_{{ $kondisi->id }}"
                                            value="{{ $kondisi->nilai }}"
                                            onchange="document.getElementById('kondisi_{{ $gejala->kode }}').value = this.value" />
                                        <label for="choice_{{ $gejala->kode }}_{{ $kondisi->id }}"
                                            class="px-3 py-2 text-xs font-medium uppercase duration-100 border border-blue-100 rounded-full shadow-md cursor-pointer bg-slate-100 hover:text-white text-slate-600 hover:bg-blue-500">{{ $kondisi->deskripsi }}</label>
                                    </li>
                                @endforeach
                                <input type="hidden" name="cf_user[{{ $gejala->kode }}]"
                                    id="kondisi_{{ $gejala->kode }}" value="" />
                            </ul>
                        </div>
                    @endforeach
                    <div class="flex justify-end">
                        <button type="submit"
                            class="flex items-center gap-4 px-12 py-2 text-xl font-bold text-white duration-100 bg-blue-500 rounded-full rounded-tl-none group hover:bg-blue-600">SUBMIT
                            <svg width="10" height="16" class="duration-100 group-hover:translate-x-2"
                                viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L7 7L1 1" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @if (session('error'))
        <script>
            swal.fire({
                title: 'Error',
                icon: 'error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ef4444',
            });
        </script>
    @endif
</x-app-layout>
