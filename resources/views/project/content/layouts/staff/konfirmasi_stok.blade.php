@extends('project.layouts.default.dashboard_staff')
@section('content')
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Barang</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">Ini adalah daftar terbaru
                    Barang</span>
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
                                        Product
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Konfirmasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800">
                                @foreach ($transaksiPending as $pending)
                                    <tr>
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $pending->product->name }}
                                        </td>
                                        <td
                                            class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                            {{ $pending['type'] }}
                                        </td>
                                        <td
                                            class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                            <span
                                                class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300">
                                                {{ $pending['status'] }} </span>
                                        </td>
                                        <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                            <form action="{{ route('confirmTransaction', ['id' => $pending->id]) }}"
                                                method="POST">
                                                @csrf
                                                @if ($pending['type'] == 'masuk')
                                                    <button type="submit" name="status" value="diterima"
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                        Diterima
                                                    </button>
                                                    <button type="submit" name="status" value="ditolak"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        Ditolak
                                                    </button>
                                                @elseif($pending['type'] == 'keluar')
                                                    <button type="submit" name="status" value="dikeluarkan"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                                        Dikeluarkan
                                                    </button>
                                                    <button type="submit" name="status" value="ditolak"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        Ditolak
                                                    </button>
                                                @endif
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
