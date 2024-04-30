<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            @if (Auth::user()->hasRole('guru'))
                <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">Nama</th>
            @endif
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Tingkat Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200  whitespace-nowrap text-ellipsis">Persentase
            </th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200  whitespace-nowrap text-ellipsis">Tanggal
            </th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($diagnosas as $diagnosa)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($diagnosas->currentPage() - 1) * $diagnosas->perPage() + $loop->iteration }}</td>
                @if (Auth::user()->hasRole('guru'))
                    <td class="py-2 text-center border-b">
                        {{ $diagnosa->name }}</td>
                @endif
                <td class="py-2 text-center border-b">{{ $diagnosa->kode_depresi }} |
                    {{ $diagnosa->deskripsi }}</td>
                <td class="py-2 text-center border-b">{{ $diagnosa->persentase }}%</td>
                <td class="py-2 text-center border-b">{{ date('d/m/Y', strtotime($diagnosa->created_at)) }}</td>
                <td class="py-2 text-center border-b">
                    <a href="{{ route('diagnosa.result.user', ['diagnosaId' => $diagnosa->id]) }}">
                        <x-primary-button>Lihat Detail</x-primary-button>
                    </a>
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
    {{ $diagnosas->onEachSide(1)->links() }}
</div>
