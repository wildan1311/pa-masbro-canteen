<x-master-layout>
    <div class="main-content">
        <div class="text-black bg-white rounded py-10">
            <!-- Component Start -->
            {{-- <div class="flex">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="w-48 bg-white shadow-2xl p-6 rounded-2xl">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-pink-100">
                                <svg class="w-4 h-4 stroke-current text-pink-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">Followers</span>
                        </div>
                        <span class="block text-4xl font-semibold mt-4">Rp. {{number_format($summary->jumlah_pending)}}</span>
                        <div class="flex text-xs mt-3 font-medium">
                            <span class="text-green-500">+8%</span>
                            <span class="ml-1 text-gray-500">last 14 days</span>
                        </div>
                    </div>
                    <div class="w-48 bg-white shadow-2xl p-6 rounded-2xl">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-red-100">
                                <svg class="w-4 h-4 stroke-current text-red-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">Likes</span>
                        </div>
                        <span class="block text-4xl font-semibold mt-4">Rp. {{number_format($summary->jumlah_minggu_ini)}}</span>
                        <div class="flex text-xs mt-3 font-medium">
                            <span class="text-green-500">+12%</span>
                            <span class="ml-1 text-gray-500">last 14 days</span>
                        </div>
                    </div>
                    <div class="w-48 bg-white shadow-2xl p-6 rounded-2xl">
                        <div class="flex items-center">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100">
                                <svg class="w-4 h-4 stroke-current text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </span>
                            <span class="ml-2 text-sm font-medium text-gray-500">Comments</span>
                        </div>
                        <span class="block text-4xl font-semibold mt-4">Rp. {{number_format($summary->jumlah_bulan_ini)}}</span>
                        <div class="flex text-xs mt-3 font-medium">
                            <span class="text-red-500">-2%</span>
                            <span class="ml-1 text-gray-500">last 14 days</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Component End  -->

            <div class="px-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Rincian Penjualan</h2>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Nama Pemesan
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Menu
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Jumlah
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPesanan as $pesanan)
                                    @foreach ($pesanan->listTransaksiDetail ?? [] as $detail)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        {{ $pesanan->user->name }}
                                                    </p>
                                                    <p class="text-gray-600 whitespace-no-wrap">pesanan-{{$pesanan->id}}</p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-full h-full rounded-full"
                                                            src="{{$detail->menusKelola->link_gambar}}"
                                                            alt="" />
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{$detail->menusKelola->nama ?? $detail->menusKelola->menus->nama}}
                                                        </p>
                                                        {{-- <p class="text-gray-600 whitespace-no-wrap">000004</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">x{{$detail->jumlah}}</p>
                                                {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap">Rp. {{number_format($detail->harga, 0, ',', '.')}}</p>
                                                {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <span
                                                    class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                    <span aria-hidden
                                                        class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                    <span class="relative">{{$detail->status}}</span>
                                                </span>
                                            </td>
                                            {{-- <td
                                            class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                            <button type="button"
                                                class="inline-block text-gray-500 hover:text-gray-700">
                                                <svg class="inline-block h-6 w-6 fill-current"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                                                </svg>
                                            </button>
                                        </td> --}}
                                        </tr>
                                    @endforeach
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
    @endpush
</x-master-layout>
