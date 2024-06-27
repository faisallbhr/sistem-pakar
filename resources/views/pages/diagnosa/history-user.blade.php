<x-app-layout>
    <section class="w-full px-4 py-8 mx-auto sm:px-6 lg:px-8 max-w-9xl">
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
            <div id="diagnosa-table" class="overflow-x-auto">
                @include('components.diagnosa.table', ['diagnosas' => $history])
            </div>
            @role('guru')
                <a href="{{ route('diagnosa.history.index') }}" class="flex justify-end">
                    <x-primary-button>Kembali</x-primary-button>
                </a>
            @endrole
        </div>

        <div id="chart" class="mt-10 -ml-2 mr-12"></div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script>
        var options = {
            series: [{
                    name: "Gangguan Mood",
                    data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
                },
                {
                    name: "Depresi Ringan",
                    data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
                },
                {
                    name: 'Depresi Sedang',
                    data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
                }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [5, 5, 5],
                curve: 'straight',
            },
            title: {
                text: 'Statistik Depresi',
                align: 'left'
            },
            legend: {
                tooltipHoverFormatter: function(val, opts) {
                    return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
                        '</strong>'
                }
            },
            markers: {
                size: 0,
                hover: {
                    sizeOffset: 6
                }
            },
            xaxis: {
                categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
                    '10 Jan', '11 Jan', '12 Jan'
                ],
            },
            tooltip: {
                y: [{
                        title: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    },
                    {
                        title: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    },
                    {
                        title: {
                            formatter: function(val) {
                                return val;
                            }
                        }
                    }
                ]
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data passed from the controller
            var chartData = @json($chartData);

            var options = {
                series: [{
                        name: "Gangguan Mood",
                        data: chartData.series['Gangguan Mood'] || []
                    },
                    {
                        name: "Depresi Ringan",
                        data: chartData.series['Depresi Ringan'] || []
                    },
                    {
                        name: 'Depresi Sedang',
                        data: chartData.series['Depresi Sedang'] || []
                    }
                ],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [5, 5, 5],
                    curve: 'straight'
                },
                title: {
                    text: 'Statistik Depresi',
                    align: 'left'
                },
                legend: {
                    tooltipHoverFormatter: function(val, opts) {
                        return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts
                            .dataPointIndex
                        ] + '</strong>'
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: chartData.dates || [],
                },
                tooltip: {
                    y: [{
                            title: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        }
                    ]
                },
                grid: {
                    borderColor: '#f1f1f1',
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#filterDiagnosa').on('input', function() {
                let keyword = $('#filterDiagnosa').val();
                let userId = window.location.pathname.split('/').pop();

                $('#diagnosa-table tbody').hide();
                $('#loading').show();
                $('#pagination__diagnosa').hide();
                $.ajax({
                    url: "{{ route('diagnosa.result.filter') }}",
                    type: "GET",
                    data: {
                        filter: keyword,
                        userId: userId !== "filter" ? userId : null
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
</x-app-layout>
