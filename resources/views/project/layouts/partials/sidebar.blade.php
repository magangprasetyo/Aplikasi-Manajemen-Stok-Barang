@php
    $url = explode('/', request()->url());
    $page_slug = $url[count($url) - 2];
@endphp

<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
    aria-label="Sidebar">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Search">
                            </div>
                        </form>
                    </li>
                    {{-- dashboard --}}
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <img src="{{ asset('img/dashboard.png') }}"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                alt="Icon">
                            <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                        </a>
                    </li>
                    {{-- Produk --}}
                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                            aria-controls="dropdown-layouts" data-collapse-toggle="dropdown-layouts">
                            <img src="{{ asset('img/product.png') }}"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                alt="Icon">
                            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Produk</span>
                            <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-layouts"
                            class="py-2 space-y-2 {{ Request::is('layouts/*') ? 'block' : 'hidden' }}">
                            <li>
                                <a href="{{ route('layouts.admin.data_produk') }}"
                                    class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                                    Data Produk
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('layouts.admin.data_categori') }}"
                                    class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                                    Kategori Produk
                                </a>
                            </li>
                    </li>
                    <li>
                        <a href="{{ route('atributproduct') }}"
                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                            Atribut Produk
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                            Export and Import
                        </a>
                    </li>
                </ul>
                </li>
                {{-- Stok --}}
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                        aria-controls="dropdown-layout" data-collapse-toggle="dropdown-layout">
                        <img src="{{ asset('img/inventory.png') }}"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            alt="Icon">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Stok</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-layout" class="space-y-2 py-2 {{ Request::is('layout/*') ? 'block' : 'hidden' }}">
                        <li>
                            <a href="{{ route('riwayatTransaksi') }}"
                                class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                                Riwayat Transaksi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('stockOpname') }}"
                                class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                                Stock Opname
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengaturanStock') }}"
                                class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700">
                                Pengaturan stok
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Supplier --}}
                <li>
                    <a href="{{ route('layouts.admin.data_supplier') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        <img src="{{ asset('img/delivery-box.png') }}"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            alt="Icon">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Supplier</span>
                    </a>
                </li>

                {{-- Pengguna --}} 
                <li>
                    <a href="{{ route('getAllUser') }}"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        <img src="{{ asset('img/people.png') }}"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            alt="Icon">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">Pengguna</span>
                    </a>
                </li>
                {{-- Laporan --}}
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                        aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
                        <img src="{{ asset('img/laporan.png') }}"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            alt="Icon">
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Laporan</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-laporan" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('laporan_stock') }}"
                                class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Laporan
                                Stok</a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Transaksi
                                Barang</a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">Laporan
                                Aktivitas</a>
                        </li>
                    </ul>
                </li>
                </ul>
                <div class="pt-2 space-y-2">
                    <a href="https://github.com/themesberg/flowbite-admin-dashboard" target="_blank"
                        class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <img src="{{ asset('img/github_3291667.png') }}"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                            alt="Icon">
                        <span class="ml-3" sidebar-toggle-item>GitHub Repository</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
