@extends('project.layouts.default.dashboard')
@section('content')
    <form action="{{ route('updateMinimumStock', ['id' => $edit_minimum_stock->id]) }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Minimum
                    Stock</label>
                <input type="number" name="minimum_stock" id="minimum_stock"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    value="{{ isset($edit_minimum_stock) ? $edit_minimum_stock->minimum_stock : '' }}"
                    placeholder="Enter minimum stock" required>
            </div>
            <button type="submit"
                class="w-full justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update
            </button>
        </div>
    </form>
@endsection
