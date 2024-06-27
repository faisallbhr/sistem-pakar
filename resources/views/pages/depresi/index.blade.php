<x-app-layout>
    @include('components.depresi.modal')

    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            <div class="mb-4 flex justify-between gap-4">
                <x-primary-button onclick="openDepresiModal()" class="flex-1">
                    Tambah Depresi
                </x-primary-button>
                <div class="flex gap-2 items-center max-w-sm w-full flex-1">
                    <x-label for="depresiSearch">Search: </x-label>
                    <x-input type="text" id="depresiSearch" name="depresiSearch"
                        placeholder="Cari berdasarkan kode depresi..." />
                </div>
            </div>
            <div id="depresi-table" class="overflow-x-auto">
                @include('components.depresi.table', ['depresis' => $depresis])
            </div>
        </div>
    </section>

    @if (session('success'))
        <script>
            swal.fire({
                title: 'Sukses',
                icon: 'success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb',
            });
        </script>
    @elseif (session('error'))
        <script>
            swal.fire({
                title: 'Error',
                icon: 'error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ef4444',
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            let typingTimer;
            const doneTypingInterval = 500;

            $('#depresiSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#depresiSearch').val();
                    $('#depresi-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__depresi').hide();

                    $.ajax({
                        url: "{{ route('depresi.search') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#depresi-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#depresi-table tbody').show();
                            $('#pagination__depresi').show();
                        }
                    })
                }, doneTypingInterval);
            })
        })
    </script>
</x-app-layout>
