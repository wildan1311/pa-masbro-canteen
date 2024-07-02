<x-master-layout>
    <div class="main-content">
        <section class="bg-white rounded p-10">
            <div class="flex flex-col gap-y-4">
                <div class="flex flex-col space-y-6 md:space-y-0 md:flex-row justify-between">
                </div>
        <section class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div>
                    <span class="block text-gray-500">Pending</span>
                    <span class="block text-2xl font-bold">Rp{{number_format($summary->jumlah_pending, 0, ',', '.')}}</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div>
                    <span class="block text-gray-500">Minggu ini </span>
                    <span class="block text-2xl font-bold">Rp{{number_format($summary->jumlah_minggu_ini, 0, ',', '.')}}</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div>
                    <span class="block text-gray-500">Bulan ini</span>
                    <span class="block text-2xl font-bold">Rp{{number_format($summary->jumlah_bulan_ini, 0, ',', '.')}}</span>
                </div>
            </div>
            <div class="flex items-center p-8 bg-white shadow rounded-lg">
                <div>
                    <span class="block text-gray-500">Total Keseluruhan</span>
                    <span class="block text-2xl font-bold">Rp{{number_format($summary->jumlah_semua, 0, ',', '.')}}</span>
                </div>
            </div>
        </section>
    </div>

        <div class="text-black bg-white rounded py-10">
            <div class="px-8">

                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Rincian Penjualan</h2>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                         class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                         No
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        No Pesanan
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Nama Pemesan
                                    </th>
                                    {{-- <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Total Harga
                                    </th> --}}
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPesanan as $pesanan)
                                    {{-- @foreach ($pesanan->listTransaksiDetail ?? [] as $detail) --}}
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $pesanan->order_id }}
                                                    </p>
                                                </div>
                                            </td>

                                            @php
                                                $tanggal = strtotime($pesanan->created_at)
                                            @endphp
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{date("d M Y H:i", $tanggal)}}</p>
                                                {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                            </td>
                                            {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-full h-full rounded-full"
                                                            src="{{$detail->menus->link_gambar}}"
                                                            alt="" />
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{$detail->menus->nama}}
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">000004</p>
                                                    </div>
                                                </div>
                                            </td> --}}
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">{{$pesanan->user->name}}</p>
                                                {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <a href="#" onclick="toggleDetail({{$pesanan->id}})" class="text-blue-500 hover:text-blue-700">Detail</a>
                                            </td>
                                        </tr>
                                        <tr id="detail-{{$pesanan->id}}" class="hidden" >
                                           <td colspan="5">
                                            <table class="table w-100">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            No
                                                        </th>
                                                        <th>
                                                            Nama menu
                                                        </th>
                                                        <th>
                                                            Jumlah
                                                        </th>
                                                        <th>
                                                            Harga
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pesanan->listTransaksiDetail as $transaksiDetail)
                                                    <tr>
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>
                                                        <td>
                                                            {{$transaksiDetail->menus->nama}}
                                                        </td>
                                                        <td>
                                                            {{$transaksiDetail->jumlah}}
                                                        </td>
                                                        <td>
                                                            {{$transaksiDetail->harga}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                           </td>
                                        </tr>

                                    {{-- @endforeach --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let tabTogglers = document.querySelectorAll("#tabs a");

                // Hide content of Pesanan Dibatalkan tab initially
                let tabContents = document.querySelectorAll("#tab-content-second > div");
                tabContents.forEach(function(tabContent) {
                    tabContent.classList.add("hidden");
                });

                tabTogglers.forEach(function(toggler) {
                    toggler.addEventListener("click", function(e) {
                        e.preventDefault();

                        let tabName = this.getAttribute("href");

                        let tabContents = document.querySelectorAll(
                            "#tab-contents-first > div, #tab-content-second > div");

                        tabContents.forEach(function(tabContent) {
                            if (tabContent.id === tabName.slice(1)) {
                                tabContent.classList.remove("hidden");
                            } else {
                                tabContent.classList.add("hidden");
                            }
                        });

                        tabTogglers.forEach(function(tabToggler) {
                            tabToggler.parentElement.classList.remove("border-t", "border-r",
                                "border-l", "-mb-px", "bg-white");
                        });

                        this.parentElement.classList.add("border-t", "border-r", "border-l", "-mb-px",
                            "bg-white");
                    });
                });
            });
        </script>
        <script>
            function toggleDetail(id) {
                var detailRow = document.getElementById('detail-' + id);
                detailRow.classList.toggle('hidden');
            }
        </script>


    @endpush
</x-master-layout>
