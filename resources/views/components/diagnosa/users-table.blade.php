<table class="w-full border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">Nama
            </th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kelas</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                </td>
                <td class="py-2 text-center border-b">
                    {{ $user->name }}</td>
                <td class="py-2 text-center border-b capitalize">{{ $user->kelas }}</td>
                <td class="py-2 text-center border-b">
                    <a href="{{ route('diagnosa.history.user', ['userId' => $user->id]) }}">
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

<div id="pagination__users" class="my-4">
    {{ $users->onEachSide(1)->links() }}
</div>
