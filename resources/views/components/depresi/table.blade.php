<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Deskripsi Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($depresis as $depresi)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($depresis->currentPage() - 1) * $depresis->perPage() + $loop->iteration }}</td>
                <td class="py-2 text-center border-b">{{ $depresi->kode }}</td>
                <td class="py-2 text-center border-b">{{ $depresi->deskripsi }}</td>
                <td class="flex justify-center gap-2 py-2 text-center border-b">
                    <x-warning-button onclick="openDepresiModal('{{ $depresi->kode }}')">Edit</x-warning-button>
                    <x-danger-button onclick="deleteDepresi('{{ $depresi->kode }}')">Hapus</x-danger-button>
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

<div id="pagination__depresi" class="my-4">
    {{ $depresis->onEachSide(1)->links() }}
</div>

@php
    $jsonData = $depresis->toArray();
@endphp

<script>
    // modal start
    function openDepresiModal(kode) {
        const form = document.querySelector('#depresi-modal form');
        const judul = document.getElementById('judul-depresi-modal')
        if (kode) {
            form.action = "{{ route('depresi.update', ['kode' => ':kode']) }}".replace(':kode', kode);
            form.innerHTML += '@method('put')'
            judul.innerText = 'edit data depresi'

            const depresis = @json($jsonData);
            const depresi = depresis.data.find(function(depresi) {
                return depresi.kode === kode;
            });

            $('#kode_depresi').val(depresi.kode);
            $('#deskripsi_depresi').val(depresi.deskripsi);
        } else {
            judul.innerText = 'tambah data depresi'
        }

        const modal = document.getElementById('depresi-modal');
        modal.style.display = 'flex';
    }

    function closeDepresiModal() {
        const modal = document.getElementById('depresi-modal');
        modal.style.display = 'none';
        $('#kode_depresi').val('');
        $('#deskripsi_depresi').val('');
    }
    // modal end

    //alert delete depresi start
    function deleteDepresi(kode) {
        swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin akan menghapus depresi dengan kode ' + kode + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#fff',
            cancelButtonText: `
                <span class="text-slate-600">Batal</span>
                `,
            confirmButtonText: 'Ya, hapus!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('depresi.destroy', ['kode' => ':kode']) }}".replace(':kode', kode),
                    type: "delete",
                    data: {
                        _token: token
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(data) {
                        location.reload()
                    },
                    error: function(xhr, status, error) {
                        location.reload()
                    }
                });
            }
        });
    }
    // alert delete depresi end
</script>
