<x-app-layout>
    @include('components.kondisi.modal')

    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            <div class="mb-4 flex justify-between gap-4">
                <x-primary-button onclick="openKondisiModal()" class="flex-1">
                    Tambah Kondisi
                </x-primary-button>
                <div class="flex gap-2 items-center max-w-sm w-full flex-1">
                    <x-label for="kondisiSearch">Search: </x-label>
                    <x-input type="text" id="kondisiSearch" name="kondisiSearch"
                        placeholder="Cari berdasarkan kondisi..." />
                </div>
            </div>
            <div id="kondisi-table" class="overflow-x-auto">
                @include('components.kondisi.table', ['kondisis', $kondisis])
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

            $('#kondisiSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#kondisiSearch').val();
                    $('#kondisi-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__kondisi').hide();

                    $.ajax({
                        url: "{{ route('kondisi.search') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#kondisi-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#kondisi-table tbody').show();
                            $('#pagination__kondisi').show();
                        }
                    })
                }, doneTypingInterval);
            })
        })
    </script>
</x-app-layout>
