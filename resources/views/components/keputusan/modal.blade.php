<div id="keputusan-modal"
    class="fixed top-0 left-0 z-50 justify-center hidden w-full bg-black bg-opacity-50 h-dvh text-slate-900 px-4">
    <div class="relative w-full max-w-md p-4 bg-white rounded-md top-10 max-h-[500px] overflow-y-auto">
        <h1 id="judul-keputusan-modal" class="mb-4 text-xl font-bold text-center capitalize">...</h1>
        <form action="{{ route('keputusan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="space-y-4">
                <div>
                    <x-label>Kode Rule</x-label>
                    <x-input name="kode_rule" id="kode_rule_keputusan" type="text" placeholder="Masukkan kode rule"
                        class="w-full mt-1" required />
                </div>
                <div id="gejala_container">
                    <x-label>Kode Gejala</x-label>
                    <div class="flex items-end gap-2 gejala-item">
                        <div class="w-full">
                            <select name="kode_gejala[]" id="kode_gejala_keputusan" class="form-input w-full">
                                <option value="" disabled selected>Pilih Kode Gejala</option>
                                @foreach ($gejalas as $gejala)
                                    <option value="{{ $gejala->kode }}">{{ $gejala->kode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button"
                            class="remove_gejala_button w-fit h-fit rounded-full p-2 text-red-600">-</button>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="button" id="add_gejala_button" class="text-gray-600 text-xs">Tambah Gejala</button>
                </div>
                <div>
                    <x-label>Kode Depresi</x-label>
                    <select name="kode_depresi" id="kode_depresi_keputusan" class="form-input w-full">
                        <option value="" disabled selected>Pilih Kode Depresi</option>
                        @foreach ($depresis as $depresi)
                            <option value="{{ $depresi->kode }}">{{ $depresi->kode }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full">
                    <x-label>CF</x-label>
                    <x-input id="cf_keputusan" name="cf" type="text" placeholder="Masukkan nilai CF"
                        class="w-full mt-1" required />
                </div>
            </div>
            <div class="flex justify-center gap-2 mt-6">
                <x-secondary-button type="button" onclick="closeKeputusanModal()">Cancel</x-secondary-button>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        const $addGejalaButton = $('#add_gejala_button');
        const $gejalaContainer = $('#gejala_container');
        const $gejalaTemplate = $('.gejala-item').first();

        function addGejala() {
            const $newGejalaItem = $gejalaTemplate.clone();
            $newGejalaItem.find('select').val('');

            $newGejalaItem.find('.remove_gejala_button').on('click', function() {
                removeGejala($newGejalaItem);
            });

            $gejalaContainer.append($newGejalaItem);
        }

        function removeGejala($gejalaItem) {
            $gejalaItem.remove();
        }

        $addGejalaButton.on('click', addGejala);

        $gejalaContainer.on('click', '.remove_gejala_button', function() {
            const $gejalaItem = $(this).closest('.gejala-item');
            removeGejala($gejalaItem);
        });
    });
</script>
