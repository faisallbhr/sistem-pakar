<x-app-layout>
    @include('components.gejala.modal')

    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            <div class="mb-4 flex justify-between gap-4">
                <x-primary-button onclick="openGejalaModal()">
                    Tambah Gejala
                </x-primary-button>
                <div class="flex gap-2 items-center max-w-sm w-full flex-1">
                    <x-label for="gejalaSearch">Search: </x-label>
                    <x-input type="text" id="gejalaSearch" name="gejalaSearch"
                        placeholder="Cari berdasarkan kode gejala..." />
                </div>
            </div>
            <div id="gejala-table" class="overflow-x-auto">
                @include('components.gejala.table', ['gejalas' => $gejalas])
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

            $('#gejalaSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#gejalaSearch').val();
                    $('#gejala-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__gejala').hide();

                    $.ajax({
                        url: "{{ route('gejala.search') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#gejala-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#gejala-table tbody').show();
                            $('#pagination__gejala').show();
                        }
                    })
                }, doneTypingInterval);
            })
        })
    </script>
</x-app-layout>
