<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Gejala</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                MB</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                MD</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($keputusans as $keputusan)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($keputusans->currentPage() - 1) * $keputusans->perPage() + $loop->iteration }}
                </td>
                <td class="py-2 text-center border-b">{{ $keputusan->kode_gejala }}</td>
                <td class="py-2 text-center border-b">{{ $keputusan->mb }}</td>
                <td class="py-2 text-center border-b">{{ $keputusan->md }}</td>
                <td class="py-2 text-center border-b">{{ $keputusan->kode_depresi }}</td>
                <td class="flex justify-center gap-2 py-2 text-center border-b">
                    <x-warning-button onclick="openKeputusanModal({{ $keputusan->id }})">Edit</x-warning-button>
                    <x-danger-button onclick="deleteGejala({{ $keputusan->id }})">Hapus</x-danger-button>
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

<div id="pagination__keputusan" class="my-4">
    {{ $keputusans->onEachSide(1)->links() }}
</div>

@php
    $jsonData = $keputusans->toArray();
@endphp

<script>
    // modal start
    function openKeputusanModal(id) {
        const form = document.querySelector('#keputusan-modal form');
        const judul = document.getElementById('judul-keputusan-modal')
        if (id) {
            form.action = "{{ route('keputusan.update', ['id' => ':id']) }}".replace(':id', id);
            form.innerHTML += '@method('put')'
            judul.innerText = 'edit data keputusan'

            const keputusans = @json($jsonData);
            const keputusan = keputusans.data.find(function(keputusan) {
                return keputusan.id === id;
            });

            $('#kode_gejala_keputusan').val(keputusan.kode_gejala);
            $('#kode_depresi_keputusan').val(keputusan.kode_depresi);
            $('#mb_keputusan').val(keputusan.mb);
            $('#md_keputusan').val(keputusan.md);
        } else {
            judul.innerText = 'tambah data keputusan'
        }

        const modal = document.getElementById('keputusan-modal');
        modal.style.display = 'flex';
    }

    function closeKeputusanModal() {
        const modal = document.getElementById('keputusan-modal');
        modal.style.display = 'none';
        $('#kode_gejala_keputusan').val('');
        $('#kode_depresi_keputusan').val('');
        $('#mb_keputusan').val('');
        $('#md_keputusan').val('');
    }
    // modal end

    //alert delete gejala start
    function deleteGejala(id) {
        swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin akan menghapus keputusan?',
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
                    url: "{{ route('keputusan.destroy', ['id' => ':id']) }}".replace(':id', id),
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
    // alert delete gejala end
</script>
