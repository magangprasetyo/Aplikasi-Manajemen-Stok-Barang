@extends('project.layouts.default.dashboard_manager')
@section('content')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <div class="px-4 pt-6">
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <!-- Card header -->
            <div class="items-center justify-between lg:flex">
                <div class="mb-4 lg:mb-0">
                    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Stok Menipis</h3>
                    <span class="text-base font-normal text-gray-500 dark:text-gray-400">Ini adalah daftar terbaru
                        Stok Barang</span>
                </div>
            </div>
            <!-- Table -->
            <div class="flex flex-col mt-6">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Nama Barang
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Stoke
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800">
                                    @foreach ($stockTipis as $productId => $data)
                                        <tr>
                                            <td
                                                class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-gray-400">
                                                {{ $data['name'] }}
                                            </td>
                                            <td
                                                class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $data['stok_akhir'] }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Barang Masuk & Keluar
            <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg
                    class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd"></path>
                </svg><span class="sr-only">Show information</span></button>
        </h3>
        <div data-popover id="popover-description" role="tooltip"
            class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
            <div class="p-3 space-y-2">
                <h3 class="font-semibold text-gray-900 dark:text-white">Statistics</h3>
                <p>Statistics is a branch of applied mathematics that involves the collection, description,
                    analysis, and inference of conclusions from quantitative data.</p>
                <a href="#"
                    class="flex items-center font-medium text-primary-600 dark:text-primary-500 dark:hover:text-primary-600 hover:text-primary-700">Read
                    more <svg class="w-4 h-4 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg></a>
            </div>
            <div data-popper-arrow></div>
        </div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs"
                class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                <option>Statistics</option>
                <option>Services</option>
                <option>FAQ</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400"
            id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
            <li class="w-full">
                <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq"
                    aria-selected="true"
                    class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Barang
                    Masuk</button>
            </li>
            <li class="w-full">
                <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about"
                    aria-selected="false"
                    class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Barang
                    Keluar</button>
            </li>
        </ul>
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
            <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($stockMasuk as $product)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate dark:text-white">
                                            {{ $product->product?->name ?? 'Unknown Product' }}
                                        </p>
                                        <div
                                            class="flex items-center justify-end flex-1 text-sm text-black-500 dark:text-black-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            </svg>
                                            {{ $product->date }}
                                            <span class="ml-2 text-green-500">{{ $product->type }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $product->quantity }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($stockKeluar as $product)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    {{-- <img class="w-8 h-8 rounded-full"
                                        src="{{ asset('static/images/users/neil-sims.png') }}" alt="Neil image"> --}}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        {{ $product->product?->name ?? 'Unknown Product' }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $product->date }}
                                        <span class="ml-2 text-red-500">{{ $product->type }}</span>
                                    </p>

                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $product->quantity }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
