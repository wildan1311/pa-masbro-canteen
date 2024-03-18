@push('css')
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
        z-index: 5;
    }
</style>
@endpush
<x-master-layout>
    <div class="main-content">
        <div class="bg-white p-3 rounded h-screen">
            <div class="container px-8">
                <div class="mt-0 mb-0">
                    <div class="font-sans text-black bg-white flex justify-between">
                        <p class="self-center">Nama Menu</p>
                        <div class="flex items-center">
                            <input type="text" class="px-4 py-2 border rounded" placeholder="Search...">
                            <button class="flex justify-center px-4 border-l items-center">
                                <i class="fas fa-search"></i>
                                {{-- <svg class="h-4 w-4 text-grey-dark" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                </svg> --}}
                            </button>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold leading-tight">3 Produk</h2>
                    </div>
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Menu
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Total terjual
                                        </th>
                                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full"
                                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                        alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        Ayam Malaysia
                                                    </p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">000004</p> --}}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="p-10">

                                                <div class="dropdown inline-block relative">
                                                    <button
                                                        class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                                                        <span class="mr-1">Ready</span>
                                                        <svg class="fill-current h-4 w-4"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                        </svg>
                                                    </button>
                                                    <ul
                                                        class="dropdown-menu absolute hidden text-gray-700 pt-1">
                                                        <li class=""><a
                                                                class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                                href="#">Ready</a></li>
                                                        <li class=""><a
                                                                class="bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                                href="#">Kosong</a></li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </td>
                                        <td class="px-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000 <i
                                                    class="fas fa-edit"></i></p>
                                            {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                        </td>
                                        <td class="px-5 border-b border-gray-200 bg-white text-sm">
                                            <span
                                                class="relative inline-block px-3 py-1 font-semibold text-red leading-tight">
                                                <span aria-hidden
                                                    class="absolute inset-0 bg-red-500 opacity-50 rounded-full"></span>
                                                <span class="relative">Dibatalkan</span>
                                            </span>
                                        </td>
                                        {{-- <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <button type="button"
                                            class="inline-block text-gray-500 hover:text-gray-700">
                                            <svg class="inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                                            </svg>
                                        </button>
                                    </td> --}}
                                    </tr>
                                </tbody>
                            </table>
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
