<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto space-y-8">

        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />

        @role('guru')
            <div class="grid grid-cols-12 gap-4">
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-500" d="M16 13v4H8v-4H0l3-9h18l3 9h-8Z" />
                            <path class="fill-current text-indigo-300"
                                d="m23.72 12 .229.686A.984.984 0 0 1 24 13v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1v-8c0-.107.017-.213.051-.314L.28 12H8v4h8v-4H23.72ZM13 0v7h3l-4 5-4-5h3V0h2Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $gejala }}</h1>
                        <span>Gejala Depresi</span>
                    </div>
                </div>
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-300"
                                d="M13 6.068a6.035 6.035 0 0 1 4.932 4.933H24c-.486-5.846-5.154-10.515-11-11v6.067Z" />
                            <path class="fill-current text-indigo-500"
                                d="M18.007 13c-.474 2.833-2.919 5-5.864 5a5.888 5.888 0 0 1-3.694-1.304L4 20.731C6.131 22.752 8.992 24 12.143 24c6.232 0 11.35-4.851 11.857-11h-5.993Z" />
                            <path class="fill-current text-indigo-600"
                                d="M6.939 15.007A5.861 5.861 0 0 1 6 11.829c0-2.937 2.167-5.376 5-5.85V0C4.85.507 0 5.614 0 11.83c0 2.695.922 5.174 2.456 7.17l4.483-3.993Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $kondisi }}</h1>
                        <span>Kondisi Depresi</span>
                    </div>
                </div>
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-500" d="M1 3h22v20H1z" />
                            <path class="fill-current text-indigo-300" d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $depresi }}</h1>
                        <span>Jenis Depresi</span>
                    </div>
                </div>
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-500" d="M8 1v2H3v19h18V3h-5V1h7v23H1V1z" />
                            <path class="fill-current text-indigo-500" d="M1 1h22v23H1z" />
                            <path class="fill-current text-indigo-300"
                                d="M15 10.586L16.414 12 11 17.414 7.586 14 9 12.586l2 2zM5 0h14v4H5z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $keputusan }}</h1>
                        <span>Keputusan</span>
                    </div>
                </div>
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-500"
                                d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z" />
                            <path class="fill-current text-indigo-300"
                                d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $diagnosa }}</h1>
                        <span>Hasil Diagnosa</span>
                    </div>
                </div>
                <div class="bg-white rounded-md p-4 flex gap-4 items-center col-span-full md:col-span-6 lg:col-span-4">
                    <div class="rounded-full bg-indigo-100 p-6 shadow">
                        <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                            <path class="fill-current text-indigo-500"
                                d="M18.974 8H22a2 2 0 012 2v6h-2v5a1 1 0 01-1 1h-2a1 1 0 01-1-1v-5h-2v-6a2 2 0 012-2h.974zM20 7a2 2 0 11-.001-3.999A2 2 0 0120 7zM2.974 8H6a2 2 0 012 2v6H6v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5H0v-6a2 2 0 012-2h.974zM4 7a2 2 0 11-.001-3.999A2 2 0 014 7z" />
                            <path class="fill-current text-indigo-300"
                                d="M12 6a3 3 0 110-6 3 3 0 010 6zm2 18h-4a1 1 0 01-1-1v-6H6v-6a3 3 0 013-3h6a3 3 0 013 3v6h-3v6a1 1 0 01-1 1z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl text-slate-800 font-bold">{{ $admin }}</h1>
                        <span>Admin</span>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-md p-4 flex gap-4 items-center">
                <div class="rounded-full bg-indigo-100 p-6 shadow">
                    <svg class="w-10 h-10 shrink-0" viewBox="0 0 24 24">
                        <path class="fill-current text-indigo-500"
                            d="M20 7a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 0120 7zM4 23a.75.75 0 01-.75-.75 1.5 1.5 0 00-1.5-1.5.75.75 0 110-1.5 1.5 1.5 0 001.5-1.5.75.75 0 111.5 0 1.5 1.5 0 001.5 1.5.75.75 0 110 1.5 1.5 1.5 0 00-1.5 1.5A.75.75 0 014 23z" />
                        <path class="fill-current text-indigo-300"
                            d="M17 23a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 010-2 4 4 0 004-4 1 1 0 012 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1zM7 13a1 1 0 01-1-1 4 4 0 00-4-4 1 1 0 110-2 4 4 0 004-4 1 1 0 112 0 4 4 0 004 4 1 1 0 010 2 4 4 0 00-4 4 1 1 0 01-1 1z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl text-slate-800 font-bold">{{ $diagnosaSiswa }}</h1>
                    <span>Hasil Diagnosa</span>
                </div>
            </div>
            <div id="dashboardChart"></div>
        @endrole
        <div class="bg-white p-4 rounded-md shadow">
            <h1 class="font-semibold mb-4 text-2xl">Pertanyaan yang sering diajukan - FAQ</h1>
            <div class="bg-white w-full border border-gray-200 rounded-md" x-data="{ selected: 1 }">
                <ul>
                    <li class="relative border-b border-gray-200">
                        <button type="button" class="w-full p-4 text-left hover:bg-gray-100 duration-300"
                            @click="selected !== 1 ? selected = 1 : selected = null"
                            x-bind:class="{ 'bg-gray-100': selected === 1 }">
                            <div class="flex items-center justify-between">
                                <h2 class="font-medium text-lg">Apa itu Depresi Check?</h2>
                                <span x-show="selected === 1">&#x2212;</span>
                                <span x-show="selected !== 1">+</span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-300" style=""
                            x-ref="container1"
                            x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="p-4">
                                <p>Depresi Check adalah sebuah situs yang membantu mahasiswa akhir mengukur tingkat
                                    depresi mereka dengan mengisi formulir pertanyaan. Kami menyediakan solusi sesuai
                                    setelah mahasiswa mengisi formulir tersebut.</p>
                            </div>
                        </div>
                    </li>
                    <li class="relative border-b border-gray-200">
                        <button type="button" class="w-full p-4 text-left hover:bg-gray-100 duration-300"
                            @click="selected !== 2 ? selected = 2 : selected = null"
                            x-bind:class="{ 'bg-gray-100': selected === 2 }">
                            <div class="flex items-center justify-between">
                                <h2 class="font-medium text-lg">Siapa yang bisa mengakses Depresi Check?</h2>
                                <span x-show="selected === 2">&#x2212;</span>
                                <span x-show="selected !== 2">+</span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-300" style=""
                            x-ref="container2"
                            x-bind:style="selected == 2 ? 'max-height: ' + $refs.container2.scrollHeight + 'px' : ''">
                            <div class="p-4">
                                <p>Depresi Check ditujukan untuk mahasiswa akhir, namun siapa saja dapat mengakses situs
                                    ini dan mengisi formulir untuk mengetahui tingkat depresi mereka.</p>
                            </div>
                        </div>
                    </li>
                    <li class="relative border-b border-gray-200">
                        <button type="button" class="w-full p-4 text-left hover:bg-gray-100 duration-300"
                            @click="selected !== 3 ? selected = 3 : selected = null"
                            x-bind:class="{ 'bg-gray-100': selected === 3 }">
                            <div class="flex items-center justify-between">
                                <h2 class="font-medium text-lg">Apakah hasil dari Depresi Check bisa
                                    diandalkan?</h2>
                                <span x-show="selected === 3">&#x2212;</span>
                                <span x-show="selected !== 3">+</span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-300" style=""
                            x-ref="container3"
                            x-bind:style="selected == 3 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                            <div class="p-4">
                                <p>Hasil dari Depresi Check adalah sebuah estimasi dari tingkat depresi seseorang, dan
                                    tidak bisa dianggap sebagai diagnosis yang pasti. Kami sangat menyarankan agar
                                    seseorang yang merasa memiliki tingkat depresi yang tinggi untuk segera meminta
                                    bantuan profesional.</p>
                            </div>
                        </div>
                    </li>
                    <li class="relative border-b border-gray-200">
                        <button type="button" class="w-full p-4 text-left hover:bg-gray-100 duration-300"
                            @click="selected !== 4 ? selected = 4 : selected = null"
                            x-bind:class="{ 'bg-gray-100': selected === 4 }">
                            <div class="flex items-center justify-between">
                                <h2 class="font-medium text-lg">Bagaimana cara mengakses solusi yang ditawarkan oleh
                                    Depresi Check?</h2>
                                <span x-show="selected === 4">&#x2212;</span>
                                <span x-show="selected !== 4">+</span>
                            </div>
                        </button>
                        <div class="relative overflow-hidden transition-all max-h-0 duration-300" style=""
                            x-ref="container4"
                            x-bind:style="selected == 4 ? 'max-height: ' + $refs.container3.scrollHeight + 'px' : ''">
                            <div class="p-4">
                                <p>Setelah mengisi formulir, mahasiswa akan menerima rekomendasi solusi sesuai dengan
                                    tingkat depresi yang terdeteksi. Kami juga menyediakan tautan ke sumber informasi
                                    dan bantuan profesional yang dapat membantu mahasiswa mengatasi depresi mereka.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
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
                ]
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
                ],
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

        var dashboardChart = new ApexCharts(document.querySelector("#dashboardChart"), options);
        dashboardChart.render();
    </script>
</x-app-layout>
