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
                                <h2 class="text-2xl font-semibold leading-tight">3 Pesanan Masuk</h2>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                        <span aria-hidden
                                                            class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                        <span class="relative">Selesai</span>
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
            <!-- Tab Contents pesanan dibatalkan -->
            <div id="tab-content-second">
                <div id="second" class="p-4">
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div>
                                <h2 class="text-2xl font-semibold leading-tight">1 Pesanan Dibatalkan</h2>
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
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            Akbar gantenk
                                                        </p>
                                                        <p class="text-gray-600 whitespace-no-wrap">001</p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">x2</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">USD</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                    <p class="text-gray-900 whitespace-no-wrap">Rp. 13.000</p>
                                                    {{-- <p class="text-gray-600 whitespace-no-wrap">Due in 3 days</p> --}}
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
