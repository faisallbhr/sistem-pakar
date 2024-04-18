<x-app-layout>
    @include('components.keputusan.modal', ['gejalas' => $gejalas, 'depresis' => $depresis])

    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        <div class="p-4 bg-white rounded-md">
            <div class="mb-4 flex justify-between">
                <x-primary-button onclick="openKeputusanModal()">
                    Tambah Data Keputusan
                </x-primary-button>
                <div class="flex gap-2 items-center max-w-sm w-full">
                    <x-label for="keputusanSearch">Search: </x-label>
                    <x-input type="text" id="keputusanSearch" name="keputusanSearch"
                        placeholder="Cari berdasarkan kode gejala/kode depresi..." />
                </div>
            </div>
            <div id="keputusan-table" class="overflow-x-auto">
                @include('components.keputusan.table', ['keputusans' => $keputusans])
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

            $('#keputusanSearch').on('input', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    let keyword = $('#keputusanSearch').val();
                    $('#keputusan-table tbody').hide();
                    $('#loading').show();
                    $('#pagination__keputusan').hide();

                    $.ajax({
                        url: "{{ route('keputusan.search') }}",
                        type: "GET",
                        data: {
                            search: keyword
                        },
                        success: function(data) {
                            $('#keputusan-table').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        },
                        complete: function() {
                            $('#loading').hide();
                            $('#keputusan-table tbody').show();
                            $('#pagination__keputusan').show();
                        }
                    })
                }, doneTypingInterval);
            })
        })
    </script>
</x-app-layout>
