<div id="kondisi-modal"
    class="fixed top-0 left-0 z-50 justify-center hidden w-full bg-black bg-opacity-50 h-dvh text-slate-900">
    <div class="relative w-full max-w-md p-4 bg-white rounded-md top-10 h-fit">
        <h1 id="judul-kondisi-modal" class="mb-4 text-xl font-bold text-center capitalize">...</h1>
        <form action="{{ route('kondisi.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <x-label>Kondisi</x-label>
                    <x-input id="deskripsi_kondisi" name="deskripsi" type="text" placeholder="Masukkan kondisi"
                        class="w-full mt-1" required />
                </div>
                <div>
                    <x-label>Nilai</x-label>
                    <x-input id="nilai_kondisi" name="nilai" type="text" placeholder="Masukkan nilai kondisi"
                        class="w-full mt-1" required />
                </div>
            </div>
            <div class="flex justify-center gap-2 mt-6">
                <x-secondary-button type="button" onclick="closeKondisiModal()">Cancel</x-secondary-button>
                <x-primary-button type="submit">Submit</x-primary-button>
            </div>
        </form>
    </div>
</div>
