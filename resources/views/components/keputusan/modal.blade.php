<div id="keputusan-modal"
    class="fixed top-0 left-0 z-50 justify-center hidden w-full bg-black bg-opacity-50 h-dvh text-slate-900">
    <div class="relative w-full max-w-md p-4 bg-white rounded-md top-10 h-fit">
        <h1 id="judul-keputusan-modal" class="mb-4 text-xl font-bold text-center capitalize">...</h1>
        <form action="{{ route('keputusan.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label>Kode Gejala</x-label>
                        <select name="kode_gejala" id="kode_gejala_keputusan" class="form-input w-full">
                            <option value="" disabled selected>Pilih Kode Gejala</option>
                            @foreach ($gejalas as $gejala)
                                <option value="{{ $gejala->kode }}">{{ $gejala->kode }}</option>
                            @endforeach
                        </select>
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
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="w-full">
                        <x-label>MB</x-label>
                        <x-input id="mb_keputusan" name="mb" type="text" placeholder="Masukkan data mb"
                            class="w-full mt-1" required />
                    </div>
                    <div class="w-full">
                        <x-label>MD</x-label>
                        <x-input id="md_keputusan" name="md" type="text" placeholder="Masukkan data md"
                            class="w-full mt-1" required />
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-2 mt-6">
                <x-secondary-button type="button" onclick="closeKeputusanModal()">Cancel</x-secondary-button>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
</div>
