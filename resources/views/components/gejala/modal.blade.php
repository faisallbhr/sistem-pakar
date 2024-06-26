<div id="gejala-modal"
    class="fixed top-0 left-0 z-50 justify-center hidden w-full bg-black bg-opacity-50 h-dvh text-slate-900 px-4">
    <div class="relative w-full max-w-md p-4 bg-white rounded-md top-10 h-fit">
        <h1 id="judul-gejala-modal" class="mb-4 text-xl font-bold text-center capitalize">...</h1>
        <form action="{{ route('gejala.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <x-label>Kode Gejala</x-label>
                    <x-input id="kode_gejala" name="kode" type="text" placeholder="Masukkan kode gejala"
                        class="w-full mt-1" required />
                </div>
                <div>
                    <x-label>Deskripsi Gejala</x-label>
                    <x-input id="deskripsi_gejala" name="deskripsi" type="text"
                        placeholder="Masukkan deskripsi gejala" class="w-full mt-1" required />
                </div>
                <div>
                    <x-label>MB</x-label>
                    <x-input id="mb_gejala" name="mb" type="text" placeholder="Masukkan nilai MB"
                        class="w-full mt-1" required />
                </div>
                <div>
                    <x-label>MD</x-label>
                    <x-input id="md_gejala" name="md" type="text" placeholder="Masukkan nilai MD"
                        class="w-full mt-1" required />
                </div>
            </div>
            <div class="flex justify-center gap-2 mt-6">
                <x-secondary-button type="button" onclick="closeGejalaModal()">Cancel</x-secondary-button>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
</div>
