<div class="border border-indigo-200 shadow rounded-md p-4">
    <h2 class="font-semibold text-2xl mb-4 text-center">{{ $artikel->judul }}</h2>
    <div class="grid md:grid-cols-2 gap-4">
        <img src="{{ $artikel->gambar }}" alt="" class="rounded-md overflow-hidden shadow">
        <p>{{ $artikel->deskripsi }}</p>
    </div>
</div>
