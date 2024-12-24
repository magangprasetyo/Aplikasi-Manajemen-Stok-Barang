@extends('project.layouts.default.dashboard')
@section('content')
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Data Produk</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">Ini adalah daftar terbaru
                    Data Produk</span>
            </div>
        </div>
        <a href="{{ route('createGetProduct') }}"  
            class="inline-block px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
            Tambah
        </a>
        
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
                                        Kategori
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Supplier
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Nama
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Sku
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($produck as $item)
                                    <tr class="@if ($loop->even) bg-gray-50 dark:bg-gray-700 @endif">
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->category->name }}
                                        </td>
                                        <td
                                            class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $item->supplier->name }}
                                        </td>
                                        <td
                                            class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->name }}
                                        </td>
                                        <td
                                            class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $item->sku }}
                                        </td>
                                        <td class="p-4">

                                            {{-- Tombol Lihat --}}
                                            <a href="{{ route('data_product', ['id' => $item->id]) }}"
                                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Lihat
                                            </a>
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('findUpdate', ['id' => $item->id]) }}"
                                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Edit
                                             </a>                                                                                        

                                            <!-- Formulir untuk Hapus -->
                                            <form action="{{ route('deleteProductById', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-block px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                                                    Hapus
                                                </button>
                                            </form>
                                            
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
@endsection
