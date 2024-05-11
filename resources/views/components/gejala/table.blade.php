<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Gejala</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Deskripsi Gejala</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                MB</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                MD</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                CF</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gejalas as $gejala)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ ($gejalas->currentPage() - 1) * $gejalas->perPage() + $loop->iteration }}</td>
                <td class="py-2 text-center border-b">{{ $gejala->kode }}</td>
                <td class="py-2 text-center border-b">{{ $gejala->deskripsi }}</td>
                <td class="py-2 text-center border-b">{{ $gejala->mb }}</td>
                <td class="py-2 text-center border-b">{{ $gejala->md }}</td>
                <td class="py-2 text-center border-b">{{ $gejala->mb - $gejala->md }}</td>
                <td class="flex justify-center gap-2 py-2 text-center border-b">
                    <x-warning-button onclick="openGejalaModal('{{ $gejala->kode }}')">Edit</x-warning-button>
                    <x-danger-button onclick="deleteGejala('{{ $gejala->kode }}')">Hapus</x-danger-button>
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

<div id="pagination__gejala" class="my-4">
    {{ $gejalas->onEachSide(1)->links() }}
</div>

@php
    $jsonData = $gejalas->toArray();
@endphp

<script>
    // modal start
    function openGejalaModal(kode) {
        const form = document.querySelector('#gejala-modal form');
        const judul = document.getElementById('judul-gejala-modal')
        if (kode) {
            form.action = "{{ route('gejala.update', ['kode' => ':kode']) }}".replace(':kode', kode);
            form.innerHTML += '@method('put')'
            judul.innerText = 'edit data gejala'

            const gejalas = @json($jsonData);
            const gejala = gejalas.data.find(function(gejala) {
                return gejala.kode === kode;
            });

            $('#kode_gejala').val(gejala.kode);
            $('#deskripsi_gejala').val(gejala.deskripsi);
            $('#mb_gejala').val(gejala.mb);
            $('#md_gejala').val(gejala.md);
        } else {
            judul.innerText = 'tambah data gejala'
            form.action = "{{ route('gejala.store') }}";
            const inputMethod = document.querySelector('[name="_method"]');
            if (inputMethod) {
                inputMethod.remove();
            }
        }

        const modal = document.getElementById('gejala-modal');
        modal.style.display = 'flex';
    }

    function closeGejalaModal() {
        const modal = document.getElementById('gejala-modal');
        modal.style.display = 'none';
        $('#kode_gejala').val('');
        $('#deskripsi_gejala').val('');
        $('#mb_gejala').val('');
        $('#md_gejala').val('');
    }
    // modal end

    //alert delete gejala start
    function deleteGejala(kode) {
        swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin akan menghapus gejala dengan kode ' + kode + '?',
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
                    url: "{{ route('gejala.destroy', ['kode' => ':kode']) }}".replace(':kode', kode),
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
