<table class="w-full overflow-x-auto border-collapse">
    <thead>
        <tr>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-l-md whitespace-nowrap text-ellipsis">
                No.</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Rule</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Gejala</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                Kode Depresi</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 whitespace-nowrap text-ellipsis">
                CF</th>
            <th class="px-2 py-2 overflow-hidden bg-gray-200 rounded-r-md whitespace-nowrap text-ellipsis">
                Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($keputusans as $keputusan)
            <tr class="hover:bg-gray-100">
                <td class="py-2 text-center border-b">
                    {{ $loop->iteration }}
                </td>
                <td class="py-2 text-center border-b">{{ $keputusan['kode_rule'] }}</td>
                <td class="py-2 text-center border-b">
                    @foreach ($keputusan['kode_gejala'] as $item)
                        {{ $item }} <br>
                    @endforeach
                    <?php $kodeGejalaStr = implode(', ', $keputusan['kode_gejala']); ?>
                <td class="py-2 text-center border-b">{{ $keputusan['kode_depresi'] }}</td>
                <td class="py-2 text-center border-b">{{ $keputusan['cf'] }}</td>
                <td class="py-2 text-center border-b">
                    <div class="flex justify-center gap-2">
                        <x-warning-button
                            onclick="openKeputusanModal({{ $keputusan['kode_rule'] }}, '{{ $kodeGejalaStr }}', '{{ $keputusan['kode_depresi'] }}', '{{ $keputusan['cf'] }}')">Edit</x-warning-button>
                        <x-danger-button onclick="deleteGejala({{ $keputusan['kode_rule'] }})">Hapus</x-danger-button>
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

<script>
    function openKeputusanModal(kodeRule, kodeGejala, kodeDepresi, cf) {
        const form = document.querySelector('#keputusan-modal form');
        const judul = document.getElementById('judul-keputusan-modal');
        const gejalaContainer = document.querySelector('#gejala_container');
        const gejalaTemplate = document.querySelector('.gejala-item');
        const selectKodeDepresi = form.querySelector('select[name="kode_depresi"]');
        const inputCf = form.querySelector('input[name="cf"]');

        if (kodeRule) {
            judul.innerText = 'Edit Data Keputusan';
            form.action = "{{ route('keputusan.update', ['kode_rule' => ':kode_rule']) }}".replace(':kode_rule',
                kodeRule);
            const methodInput = form.querySelector('input[name="_method"]');
            methodInput.value = 'PUT'

            form.querySelector('input[name="kode_rule"]').value = kodeRule;

            const kodeGejalaArray = kodeGejala.split(',').map(gejala => gejala.trim());

            gejalaContainer.innerHTML = '';

            kodeGejalaArray.forEach((gejala, index) => {
                const newGejalaItem = gejalaTemplate.cloneNode(true);

                newGejalaItem.querySelector('select').id = `kode_gejala_keputusan_${index}`;

                const selectGejala = newGejalaItem.querySelector('select[name="kode_gejala[]"]');
                for (let option of selectGejala.options) {
                    if (option.value === gejala) {
                        option.selected = true;
                    }
                }

                gejalaContainer.appendChild(newGejalaItem);
            });

            selectKodeDepresi.value = kodeDepresi;
            inputCf.value = cf;
        } else {
            judul.innerText = 'Tambah Data Keputusan';
            form.action = "{{ route('keputusan.store') }}";
            const inputMethod = document.querySelector('[name="_method"]');
            if (inputMethod) {
                inputMethod.remove();
            }
        }

        const modal = document.getElementById('keputusan-modal');
        modal.style.display = 'flex';
    }


    function closeKeputusanModal() {
        const modal = document.getElementById('keputusan-modal');
        modal.style.display = 'none';

        const form = document.querySelector('#keputusan-modal form');
        form.querySelector('input[name="kode_rule"]').value = '';
        form.querySelector('select[name="kode_depresi"]').value = '';
        form.querySelector('input[name="cf"]').value = '';

        const gejalaTemplate = document.querySelector('.gejala-item');
        const gejalaContainer = document.querySelector('#gejala_container');
        gejalaContainer.innerHTML = '';

        const newGejalaItem = gejalaTemplate.cloneNode(true);
        newGejalaItem.querySelector('select[name="kode_gejala[]"]').value = '';
        gejalaContainer.appendChild(newGejalaItem);
    }
</script>

<script>
    function deleteGejala(kodeRule) {
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
                    url: "{{ route('keputusan.destroy', ['kode_rule' => ':kode_rule']) }}".replace(
                        ':kode_rule', kodeRule),
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
</script>
