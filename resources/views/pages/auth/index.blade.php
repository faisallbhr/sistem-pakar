<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl space-y-4">
        @foreach ($admins as $admin)
            <div class="p-4 bg-white rounded-md shadow hover:shadow-md duration-100">
                <h2>{{ $admin->name }}</h2>
                <span class="text-sm text-slate-400">{{ $admin->email }}</span>
            </div>
        @endforeach
        <div class="my-4">
            {{ $admins->onEachSide(1)->links() }}
        </div>
    </section>
</x-app-layout>
