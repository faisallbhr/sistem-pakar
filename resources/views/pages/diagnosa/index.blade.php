<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            @role('guru')
                <div class="mb-4 max-w-sm">
                    <div class="flex gap-2 items-center">
                        <x-label for="userSearch">Search: </x-label>
                        <x-input type="text" id="userSearch" name="userSearch" placeholder="Cari berdasarkan nama..." />
                    </div>
                </div>
            @else
                <div class="mb-4 max-w-sm">
                    <div class="flex gap-2 items-center">
                        <x-label for="filterDiagnosa">Filter: </x-label>
                        <div class="relative">
                            <input id="filterDiagnosa"
                                class=" form-input pl-9 dark:bg-slate-800 text-slate-500 hover:text-slate-600 dark:text-slate-300 dark:hover:text-slate-200 font-medium w-[15.5rem]"
                                placeholder="Select dates" type="date" name="filterDiagnosa" />
                            <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                <svg class="w-4 h-4 fill-current text-slate-500 dark:text-slate-400 ml-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            @endrole
            <div id="users-table" class="overflow-x-auto">
                @include('components.diagnosa.users-table', ['users' => $users])
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            let typingTimer;
            const doneTypingInterval = 500;

            $('#userSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#userSearch').val();
                    $('#users-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__users').hide();

                    console.log(keyword)
                    $.ajax({
                        url: "{{ route('diagnosa.history.index') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#users-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#users-table tbody').show()
                            $('#pagination__users').show();
                        }
                    })
                }, doneTypingInterval);
            })
        })
    </script>
</x-app-layout>
