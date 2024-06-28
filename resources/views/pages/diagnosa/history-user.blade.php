<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
        @role('guru')
            <div id="chart"></div>
        @endrole
        <div class="p-4 bg-white rounded-md">
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
            <div id="history-table" class="overflow-x-auto">
                @include('components.diagnosa.table', ['history' => $history])
            </div>
            @role('guru')
                <a href="{{ route('diagnosa.history.index') }}" class="flex justify-end">
                    <x-primary-button>Kembali</x-primary-button>
                </a>
            @endrole
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            var options = {
                series: [{
                    name: 'Tingkat Depresi',
                    data: [
                        @foreach ($dataForChart as $data)
                            {
                                x: '{{ $data['tanggal'] }}',
                                y: {{ $data['kategoriDepresi'] }},
                                persentase: {{ $data['persentase'] }}
                            },
                        @endforeach
                    ].reverse()
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: [
                        @foreach ($dataForChart as $data)
                            '{{ $data['tanggal'] }}',
                        @endforeach
                    ].reverse(),
                    labels: {
                        rotate: -45
                    }
                },
                yaxis: {
                    title: {
                        text: 'Tingkat Depresi'
                    },
                    labels: {
                        formatter: function(val) {
                            if (val === 1) return 'Tidak Depresi';
                            else if (val === 2) return 'Gangguan Mood';
                            else if (val === 3) return 'Depresi Ringan';
                            else if (val === 4) return 'Depresi Sedang';
                            else if (val === 5) return 'Depresi Berat';
                            else return '';
                        }
                    },
                    min: 0,
                    max: 5,
                    tickAmount: 5,
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        var data = w.globals.initialSeries[seriesIndex].data[dataPointIndex];
                        var kategoriDepresi = getDepressionCategory(data.y);
                        var persentase = data.persentase;

                        return '<div class="p-4">' +
                            '<span><strong>Tanggal:</strong> ' + data.x + '</span><br>' +
                            '<span><strong>Tingkat Depresi:</strong> ' + kategoriDepresi + '</span><br>' +
                            '<span><strong>Persentase:</strong> ' + persentase + '%</span>' +
                            '</div>';
                    }
                }
            };

            function getDepressionCategory(val) {
                if (val === 1) return 'Tidak Depresi';
                else if (val === 2) return 'Gangguan Mood';
                else if (val === 3) return 'Depresi Ringan';
                else if (val === 4) return 'Depresi Sedang';
                else if (val === 5) return 'Depresi Berat';
                else return '';
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            $('#filterDiagnosa').on('input', function() {
                let keyword = $('#filterDiagnosa').val();
                let userId = window.location.pathname.split('/').pop();

                $('#history-table tbody').hide();
                $('#loading').show();
                $('#pagination__diagnosa').hide();
                $.ajax({
                    url: "{{ route('diagnosa.history.user', ['userId' => ':userId']) }}".replace(
                        ':userId', userId),
                    type: "GET",
                    data: {
                        filter: keyword,
                        userId: userId !== "filter" ? userId : null
                    },
                    success: function(response) {
                        $('#history-table').html(response.html);
                        updateChart(response.chartData);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                    complete: function() {
                        $('#loading').hide();
                        $('#history-table tbody').show();
                        $('#pagination__diagnosa').show();
                    }
                })
            })

            function updateChart(newData) {
                chart.updateSeries([{
                    name: 'Tingkat Depresi',
                    data: newData.map(item => ({
                        x: item.tanggal,
                        y: item.kategoriDepresi,
                        persentase: item.persentase
                    })).reverse()
                }]);

                chart.updateOptions({
                    xaxis: {
                        categories: newData.map(item => item.tanggal).reverse()
                    }
                });
            }
        })
    </script>
</x-app-layout>
