<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kondisi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Nilai</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kondisis as $kondisi)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($kondisis->currentPage() - 1) * $kondisis->perPage() + $loop->iteration }}
                </td>
                <td class="py-2 text-center border-b">{{ $kondisi->deskripsi }}</td>
                <td class="py-2 text-center border-b">{{ $kondisi->nilai }}</td>
                <td class="flex justify-center gap-2 py-2 text-center border-b">
                    <x-warning-button onclick="openKondisiModal({{ $kondisi->id }})">Edit</x-warning-button>
                    <x-danger-button onclick="deleteKondisi({{ $kondisi->id }})">Hapus</x-danger-button>
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

<div id="pagination__kondisi" class="my-4">
    {{ $kondisis->onEachSide(1)->links() }}
</div>

@php
    $jsonData = $kondisis->toArray();
@endphp

<script>
    // modal start
    function openKondisiModal(id) {
        const form = document.querySelector('#kondisi-modal form');
        const judul = document.getElementById('judul-kondisi-modal')
        if (id) {
            form.action = "{{ route('kondisi.update', ['id' => ':id']) }}".replace(':id', id);
            form.innerHTML += '@method('put')'
            judul.innerText = 'edit data kondisi'

            const kondisis = @json($jsonData);
            const konsisi = kondisis.data.find(function(konsisi) {
                return konsisi.id === id;
            });

            $('#deskripsi_kondisi').val(konsisi.deskripsi);
            $('#nilai_kondisi').val(konsisi.nilai);
        } else {
            judul.innerText = 'tambah data kondisi'
            form.action = "{{ route('kondisi.store') }}";
            const inputMethod = document.querySelector('[name="_method"]');
            if (inputMethod) {
                inputMethod.remove();
            }
        }

        const modal = document.getElementById('kondisi-modal');
        modal.style.display = 'flex';
    }

    function closeKondisiModal() {
        const modal = document.getElementById('kondisi-modal');
        modal.style.display = 'none';
        $('#deskripsi_kondisi').val('');
        $('#nilai_kondisi').val('');
    }
    // modal end

    //alert delete gejala start
    function deleteKondisi(id) {
        swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin akan menghapus kondisi?',
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
                    url: "{{ route('kondisi.destroy', ['id' => ':id']) }}".replace(':id', id),
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
