<table class="w-full border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            @if (Auth::user()->hasRole('guru'))
                <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">Nama</th>
            @endif
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Tingkat Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kelas</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200  whitespace-nowrap text-ellipsis">Persentase
            </th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200  whitespace-nowrap text-ellipsis">Tanggal
            </th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($history as $item)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($history->currentPage() - 1) * $history->perPage() + $loop->iteration }}</td>
                @if (Auth::user()->hasRole('guru'))
                    <td class="py-2 text-center border-b">
                        {{ $item->name }}</td>
                @endif
                <td class="py-2 text-center border-b">{{ $item->kode_depresi }} |
                    {{ $item->deskripsi }}</td>
                <td class="py-2 text-center border-b capitalize">{{ $item->kelas }}</td>
                <td class="py-2 text-center border-b">
                    @if ($item->persentase == 0)
                        -
                    @else
                        {{ $item->persentase }}%
                    @endif
                </td>
                <td class="py-2 text-center border-b">{{ date('d/m/Y', strtotime($item->created_at)) }}</td>
                <td class="py-2 text-center border-b">
                    <div class="flex items-center space-x-3.5 justify-center">
                        <a href="{{ route('diagnosa.download', ['id' => $item->id]) }}" title="Download"
                            class="hover:text-green-500">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.75 17.25a.75.75 0 0 1 .75.75v2.25c0 .138.112.25.25.25h12.5a.25.25 0 0 0 .25-.25V18a.75.75 0 0 1 1.5 0v2.25A1.75 1.75 0 0 1 18.25 22H5.75A1.75 1.75 0 0 1 4 20.25V18a.75.75 0 0 1 .75-.75Z">
                                </path>
                                <path
                                    d="M5.22 9.97a.749.749 0 0 1 1.06 0l4.97 4.969V2.75a.75.75 0 0 1 1.5 0v12.189l4.97-4.969a.749.749 0 1 1 1.06 1.06l-6.25 6.25a.749.749 0 0 1-1.06 0l-6.25-6.25a.749.749 0 0 1 0-1.06Z">
                                </path>
                            </svg>
                        </a>
                        <a href="{{ route('diagnosa.result.user', ['diagnosaId' => $item->id]) }}" title="Lihat detail"
                            class="hover:text-blue-500">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512"
                                height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                                <path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                                    d="M255.66 112c-77.94 0-157.89 45.11-220.83 135.33a16 16 0 0 0-.27 17.77C82.92 340.8 161.8 400 255.66 400c92.84 0 173.34-59.38 221.79-135.25a16.14 16.14 0 0 0 0-17.47C428.89 172.28 347.8 112 255.66 112z">
                                </path>
                                <circle cx="256" cy="256" r="80" fill="none" stroke-miterlimit="10"
                                    stroke-width="32"></circle>
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="loading" class="hidden">
    <div class="flex justify-center my-4">
        <div class="loader"></div>
    </div>
</div>

<div id="pagination__diagnosa" class="my-4">
    {{ $history->onEachSide(1)->links() }}
</div>
