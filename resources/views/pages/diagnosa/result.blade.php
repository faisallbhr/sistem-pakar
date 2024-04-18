<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-8 space-y-8 bg-white rounded-md">
            <table class="w-full max-w-xl mx-auto overflow-x-auto border-collapse">
                <thead>
                    <tr>
                        <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                            Tingkat Depresi
                        </th>
                        <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                            Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 text-center border-b border-r-indigo-200">
                            {{ $diagnosa_dipilih['kode_depresi']->kode }} |
                            {{ $diagnosa_dipilih['kode_depresi']->deskripsi }}</td>
                        <td class="py-2 text-center border-b border-r-indigo-200">{{ $diagnosa_dipilih['value'] * 100 }}%
                        </td>
                    </tr>
                </tbody>
            </table>

            {{-- table nilai --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="w-full max-w-sm p-2 pb-0 border border-indigo-200 rounded-md">
                    <h2 class="pb-2 mb-2 font-bold text-center border-b border-indigo-200">Pakar</h2>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">No</th>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">Gejala
                                </th>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">Nilai
                                    (MB-MD)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pakar as $item)
                                <tr>
                                    <td class="py-2 text-center border-b">{{ $loop->iteration }}</td>
                                    <td class="py-2 text-center border-b">{{ $item->kode_gejala }} |
                                        {{ $item->kode_depresi }}</td>
                                    <td class="py-2 text-center border-b">{{ $item->mb - $item->md }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-full max-w-sm p-2 pb-0 border border-indigo-200 rounded-md">
                    <h2 class="pb-2 mb-2 font-bold text-center border-b border-indigo-200">User</h2>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">No</th>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">Gejala
                                </th>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">Nilai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gejala_by_user as $item)
                                <tr>
                                    <td class="py-2 text-center border-b">{{ $loop->iteration }}</td>
                                    <td class="py-2 text-center border-b">{{ $item[0] }} </td>
                                    <td class="py-2 text-center border-b">{{ $item[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-full max-w-sm p-2 pb-0 border border-indigo-200 rounded-md">
                    <h2 class="pb-2 mb-2 font-bold text-center border-b border-indigo-200">Hasil</h2>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-2 py-2 overflow-hidden border-b whitespace-nowrap text-ellipsis">Nilai
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cfKombinasi['cf'] as $item)
                                <tr>
                                    <td class="py-2 text-center border-b">{{ $item }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- hasil --}}
            <div>
                <h2>Hasil</h2>
                <div>
                    <h2>{{ $diagnosa_dipilih['kode_depresi']->kode }} |
                        {{ $diagnosa_dipilih['kode_depresi']->deskripsi }}</h2>
                    <p>Jadi dapat disimpulkan bahwa pasien mengalami tingkat depresi yaitu
                        {{ round($hasil['value'] * 100, 2) }}</p>
                </div>
            </div>

            {{-- artikel --}}
            @include('components.artikel.index', ['artikel' => $artikel])
            <a href="{{ route('diagnosa.result.index') }}" class="block">
                <x-primary-button>
                    Kembali
                </x-primary-button>
            </a>
        </div>
    </section>
</x-app-layout>
