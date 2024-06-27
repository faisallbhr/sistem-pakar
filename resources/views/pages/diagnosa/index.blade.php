<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            @role('guru')
                <div class="mb-4 max-w-sm">
                    <div class="flex gap-2 items-center">
                        <x-label for="diagnosaSearch">Search: </x-label>
                        <x-input type="text" id="diagnosaSearch" name="diagnosaSearch"
                            placeholder="Cari berdasarkan nama..." />
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
            <div id="diagnosa-table" class="overflow-x-auto">
                @include('components.diagnosa.table', ['diagnosas' => $diagnosas])
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            let typingTimer;
            const doneTypingInterval = 500;

            $('#diagnosaSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#diagnosaSearch').val();
                    $('#diagnosa-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__diagnosa').hide();


                    $.ajax({
                        url: "{{ route('diagnosa.result.search') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#diagnosa-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#diagnosa-table tbody').show()
                            $('#pagination__diagnosa').show();
                        }
                    })
                }, doneTypingInterval);
            })

            $('#filterDiagnosa').on('input', function() {
                let keyword = $('#filterDiagnosa').val();
                $('#diagnosa-table tbody').hide();
                $('#loading').show();
                $('#pagination__diagnosa').hide();

                $.ajax({
                    url: "{{ route('diagnosa.result.filter') }}",
                    type: "GET",
                    data: {
                        filter: keyword
                    },
                    success: function(data) {
                        $('#diagnosa-table').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                    complete: function() {
                        $('#loading').hide();
                        $('#diagnosa-table tbody').show();
                        $('#pagination__diagnosa').show();
                    }
                })
            })
        })
    </script>

    {{-- <script>
        const filterDiagnosa = document.getElementById('filterDiagnosa');

        filterDiagnosa.addEventListener('change', function() {
            const selectedDate = this.value;
            const formattedSelectedDate = selectedDate.split('-').reverse().join('/');
            const rows = document.querySelectorAll('#diagnosa-table table tbody tr');

            rows.forEach(function(row) {
                let tanggalDiagnosa = row.cells[3].innerText;

                if (tanggalDiagnosa === formattedSelectedDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script> --}}
</x-app-layout>
