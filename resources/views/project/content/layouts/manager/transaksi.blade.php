@extends('project.layouts.default.dashboard_manager')
@section('content')
    <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        {{-- Data Categori --}}
        <div class="col-span-2">
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">Data Barang Masuk dan Keluar</h3>
                <form action="{{ route('createStockTransaction') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-6 gap-6">

                        <!-- Product ID -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="product_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                            <select name="product_id" id="product_id"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="" disabled selected>Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Type -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="type"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select name="type" id="type"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="masuk">Masuk</option>
                                <option value="keluar">Keluar</option>
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="quantity"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                            <input type="number" name="quantity" id="quantity"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Jumlah Barang">
                        </div>

                        <!-- Date -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" name="date" id="date"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>

                        <!-- Notes -->
                        <div class="col-span-6 sm:col-full">
                            <label for="notes"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                            <textarea name="notes" id="notes"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Catatan tambahan..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-span-6 sm:col-full">
                            <button type="submit"
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection