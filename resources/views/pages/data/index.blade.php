<x-master-layout>
    <div class="main-content">
        <section class="bg-white rounded p-10">
            <div class="flex flex-col gap-y-4">
                <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
                    <div class="mr-6">
                        <h1 class="text-4xl font-semibold mb-2">Yuk Cek Hasil Penjualan Toko Kamu</h1>
                    </div>
                </div>
                <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-gray-500">Total Pesanan Masuk</span>
                            <span class="block text-2xl font-bold">{{ $jumlahPesananMasuk }}</span>

                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-gray-500">Total Pesanan Selesai</span>
                            <span class="block text-2xl font-bold">{{ $jumlahPesananSelesai }}</span>

                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-gray-500">Total Pesanan Dibatalkan</span>
                            <span class="block text-2xl font-bold">{{ $jumlahPesananDitolak }}</span>
                        </div>
                    </div>
                    <div class="flex items-center p-8 bg-white shadow rounded-lg">
                        <div
                            class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6">
                            <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="block text-gray-500">Total Penjualan</span>
                            <span class="block text-2xl font-bold">Rp. {{ number_format($totalKeuangan) }}</span>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section class="flex justify-between w-full gap-10 bg-white rounded p-10">
            <!-- Chart widget -->
            <div
                class="flex flex-grow flex-col col-span-full shadow xl:col-span-8 bg-white rounded-sm border border-gray-200">
                <header class="px-5 py-4 border-b border-gray-100 flex items-center">
                    <h2 class="font-semibold text-gray-800">Penjualan Bulanan</h2>
                </header>

                <!-- Chart built with Chart.js 3 -->
                <div class="flex-grow">
                    <canvas id="analytics-card-01" width="800" height="300"></canvas>
                </div>
            </div>

            <!-- Menu paling sering dipesan -->
            <div class="flex flex-col bg-white shadow rounded-lg h-full w-[372px]">
                <div class="flex items-center justify-between px-6 py-5 font-semibold border-b border-gray-100">
                    <span>Menu Paling Sering Dipesan</span>
                    <!-- Refer here for full dropdown menu code: https://tailwindui.com/components/application-ui/elements/dropdowns -->
                </div>
                <div class="overflow-y-auto h-full">
                    <ul class="p-6 space-y-6">
                        @foreach ($listTransaksiDetail as $transaksi)
                            <li class="flex items-center">
                                <div class="h-10 w-10 mr-3 bg-gray-100 rounded-full overflow-hidden">
                                    <img src="{{asset($transaksi->gambar)}}">
                                </div>
                                <span class="text-gray-600">{{$transaksi->nama ?? $transaksi->nama_menu}}</span>
                                <span class="ml-auto font-semibold">{{$transaksi->total_pembelian}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

    </div>

    @push('jsLibrary')
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
            integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush

    @push('js')
        <script>
            // Helper function to display thousands in K format const formatThousands=(value)=>
            // Intl.NumberFormat('en-US', {
            //     maximumSignificantDigits: 3,
            //     notation: 'compact',
            // }).format(10);

            // Define Chart.js default settings
            // Chart.defaults.font.family = '"Inter", sans-serif';
            // Chart.defaults.font.weight = '500';
            // Chart.defaults.color = 'rgb(148, 163, 184)';
            // Chart.defaults.scale.grid.color = 'rgb(241, 245, 249)';
            // Chart.defaults.plugins.tooltip.titleColor = 'rgb(30, 41, 59)';
            // Chart.defaults.plugins.tooltip.bodyColor = 'rgb(30, 41, 59)';
            // Chart.defaults.plugins.tooltip.backgroundColor = '#FFF';
            // Chart.defaults.plugins.tooltip.borderWidth = 1;
            // Chart.defaults.plugins.tooltip.borderColor = 'rgb(226, 232, 240)';
            // Chart.defaults.plugins.tooltip.displayColors = false;
            // Chart.defaults.plugins.tooltip.mode = 'nearest';
            // Chart.defaults.plugins.tooltip.intersect = false;
            // Chart.defaults.plugins.tooltip.position = 'nearest';
            // Chart.defaults.plugins.tooltip.caretSize = 0;
            // Chart.defaults.plugins.tooltip.caretPadding = 20;
            // Chart.defaults.plugins.tooltip.cornerRadius = 4;
            // Chart.defaults.plugins.tooltip.padding = 8;

            // A chart built with Chart.js 3
            // https://www.chartjs.org/
            const ctx = document.getElementById('analytics-card-01');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        '12-01-2020', '01-01-2021', '02-01-2021',
                        '03-01-2021', '04-01-2021', '05-01-2021',
                        '06-01-2021', '07-01-2021', '08-01-2021',
                        '09-01-2021', '10-01-2021', '11-01-2021',
                        '12-01-2021', '01-01-2022', '02-01-2022',
                        '03-01-2022', '04-01-2022', '05-01-2022',
                        '06-01-2022', '07-01-2022', '08-01-2022',
                        '09-01-2022', '10-01-2022', '11-01-2022',
                        '12-01-2022', '01-01-2023',
                    ],
                    datasets: [
                        // Indigo line
                        {
                            label: 'Current',
                            data: [
                                5000, 8700, 7500, 12000, 11000, 9500, 10500,
                                10000, 15000, 9000, 10000, 7000, 22000, 7200,
                                9800, 9000, 10000, 8000, 15000, 12000, 11000,
                                13000, 11000, 15000, 17000, 18000,
                            ],
                            fill: true,
                            backgroundColor: 'rgba(59, 130, 246, 0.08)',
                            borderColor: 'rgb(99, 102, 241)',
                            borderWidth: 2,
                            tension: 0,
                            pointRadius: 0,
                            pointHoverRadius: 3,
                            pointBackgroundColor: 'rgb(99, 102, 241)',
                        },
                        // Gray line
                        {
                            label: 'Previous',
                            data: [
                                8000, 5000, 6500, 5000, 6500, 12000, 8000,
                                9000, 8000, 8000, 12500, 10000, 10000, 12000,
                                11000, 16000, 12000, 10000, 10000, 14000, 9000,
                                10000, 15000, 12500, 14000, 11000,
                            ],
                            borderColor: 'rgb(203, 213, 225)',
                            fill: false,
                            borderWidth: 2,
                            tension: 0,
                            pointRadius: 0,
                            pointHoverRadius: 3,
                            pointBackgroundColor: 'rgb(203, 213, 225)',
                        },
                    ],
                },
                options: {
                    layout: {
                        padding: 20,
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true,
                    //         grid: {
                    //             drawBorder: false,
                    //         },
                    //         ticks: {
                    //             callback: (value) => formatThousands(value),
                    //         },
                    //     },
                    //     x: {
                    //         type: 'time',
                    //         time: {
                    //             parser: 'MM-DD-YYYY',
                    //             unit: 'month',
                    //             displayFormats: {
                    //                 month: 'MMM YY',
                    //             },
                    //         },
                    //         // grid: {
                    //         //     display: false,
                    //         //     drawBorder: false,
                    //         // },
                    //         // ticks: {
                    //         //     autoSkipPadding: 48,
                    //         //     maxRotation: 0,
                    //         // },
                    //     },
                    // },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            callbacks: {
                                title: () => false, // Disable tooltip title
                                // label: (context) => formatThousands(context.parsed.y),
                            },
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: 'nearest',
                    },
                    maintainAspectRatio: false,
                },
            });
        </script>
    @endpush

</x-master-layout>
