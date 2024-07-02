<x-master-layout>
    <div class="main-content">
        <div class="bg-white p-5 rounded">
            <!-- Tabs -->
            <ul id="tabs" class="flex border-b">
                <li id="pesananMasuk" class="px-4 py-2"><a href="#first">Pesanan Masuk</a></li>
                <li id="pesananBatal" class="px-4 py-2"><a href="#second">Pesanan Dibatalkan</a></li>
            </ul>

            <!-- Tab Contents pesanan masuk -->
            <div id="tab-contents-first">
                <div id="first" class="p-4">
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div>
                                @php
                                    $pesananTotal = $dataPesanan
                                        ->where('status', '!=', 'pesanan_ditolak')
                                        ->reduce(function ($carry, $pesan) {
                                            return $carry + $pesan->listTransaksiDetail->count();
                                        });
                                @endphp
                                <h2 class="text-2xl font-semibold leading-tight">{{ $pesananTotal }} Pesanan
                                    Masuk</h2>
                            </div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full rounded-lg overflow-hidden">
                                    @include('components.tabel_pemesanan' , ['dataPesanan' => $dataPesanan->where('status', '!=', 'pesanan_ditolak')])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tab Contents pesanan dibatalkan -->
            <div id="tab-content-second">
                <div id="second" class="p-4">
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div>
                                @php
                                    $pesananTotalBatal = $dataPesanan
                                        ->where('status', '==', 'pesanan_ditolak')
                                        ->reduce(function ($carry, $pesan) {
                                            return $carry + $pesan->listTransaksiDetail->count();
                                        });
                                @endphp
                                <h2 class="text-2xl font-semibold leading-tight">
                                    {{ $pesananTotalBatal ?? 0 }} Pesanan Dibatalkan
                                </h2>
                            </div>
                            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                <div class="inline-block min-w-full rounded-lg overflow-hidden">
                                    @include('components.tabel_pemesanan', ['dataPesanan' => $dataPesanan->where('status', 'pesanan_ditolak')])
                                </div>
                            </div>
                        </div>
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
