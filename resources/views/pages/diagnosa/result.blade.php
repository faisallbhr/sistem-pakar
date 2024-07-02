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
                            Tingkat Kepercayaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 text-center border-b border-r-indigo-200">
                            {{ $diagnosa->kode_depresi }} |
                            {{ $diagnosa->deskripsi }}</td>
                        <td class="py-2 text-center border-b border-r-indigo-200">
                            {{ $diagnosa->persentase }}%
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-y-20">
                <table class="w-full max-w-xl mx-auto overflow-x-auto border-collapse">
                    <caption class="bg-orange-500 rounded-md mb-1 py-2 text-white font-bold">Evidence</caption>
                    <thead>
                        <tr>
                            <th
                                class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                                No.</th>
                            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">Kode
                                Gejala</th>
                            <th
                                class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                                Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $nomor = 1; @endphp
                        @foreach (json_decode($diagnosa->evidence, true) as $key => $value)
                            <tr class="border-collapse">
                                <td class="text-center py-2 border-b">{{ $nomor }}
                                </td>
                                <td class="text-center py-2 border-b">{{ $key }}
                                </td>
                                <td class="text-center py-2 border-b">{{ $value }}
                                </td>
                            </tr>
                            @php $nomor++; @endphp
                        @endforeach
                    </tbody>
                </table>

                <table class="w-full max-w-xl mx-auto overflow-x-auto border-collapse">
                    <caption class="bg-orange-500 rounded-md mb-1 py-2 text-white font-bold">CF User</caption>
                    <thead>
                        <tr>
                            @foreach (json_decode($diagnosa->cf_user, true) as $key => $values)
                                <th
                                    class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis @if ($loop->first) rounded-l-md @endif
                                @if ($loop->last) rounded-r-md @endif">
                                    Rule {{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach (json_decode($diagnosa->cf_user, true) as $key => $values)
                                <td class="text-center align-text-top">
                                    @foreach ($values as $value)
                                        <span class="py-2 block border-b">{{ $value }}</span>
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <table class="w-full max-w-xl mx-auto overflow-x-auto border-collapse">
                    <caption class="bg-orange-500 rounded-md mb-1 py-2 text-white font-bold">Min. Gejala</caption>
                    <thead>
                        <tr>
                            @foreach (json_decode($diagnosa->min_gejala, true) as $key => $values)
                                <th
                                    class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis @if ($loop->first) rounded-l-md @endif
                                @if ($loop->last) rounded-r-md @endif">
                                    Rule {{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-collapse">
                            @foreach (json_decode($diagnosa->min_gejala, true) as $key => $value)
                                <td class="text-center align-text-top border-b py-2">{{ $value }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

                <table class="w-full max-w-xl mx-auto overflow-x-auto border-collapse">
                    <caption class="bg-orange-500 rounded-md mb-1 py-2 text-white font-bold">CF Rule</caption>
                    <thead>
                        <tr>
                            @foreach (json_decode($diagnosa->cf_rule, true) as $key => $values)
                                <th
                                    class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis @if ($loop->first) rounded-l-md @endif
                                @if ($loop->last) rounded-r-md @endif">
                                    Rule {{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-collapse">
                            @foreach (json_decode($diagnosa->cf_rule, true) as $key => $value)
                                <td class="text-center align-text-top border-b py-2">{{ $value }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- hasil --}}
            <div>
                @if ($diagnosa->kode_depresi != 'P000')
                    <p>Jadi dapat disimpulkan bahwa pasien mengalami
                        <span class="text-black font-bold">{{ $diagnosa->deskripsi }}</span>
                        sebesar {{ $diagnosa->persentase }}%
                    </p>
                    <p><span class="text-black font-bold">*Catatan:</span> Silahkan datang ke Guru BK <span
                            class="capitalize">{{ Auth::user()->roles[0]->name }}</span> sebelum tanggal
                        {{ $deadline }} saat jam istirahat.</p>
                @else
                    <p>Jadi dapat disimpulkan bahwa pasien tidak mengalami depresi apapun</p>
                @endif
            </div>

            {{-- artikel --}}
            @if ($diagnosa->kode_depresi != 'P000')
                @include('components.artikel.index', ['artikel' => $artikel])
            @endif
            <a href="{{ route('diagnosa.history.user', ['userId' => $diagnosa->user_id]) }}" class="block">
                <x-primary-button>
                    Kembali
                </x-primary-button>
            </a>
        </div>
    </section>
</x-app-layout>
