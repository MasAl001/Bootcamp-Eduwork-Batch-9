<x-app-layout title="Product Categories">
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Categories') }}
            </h2>
            <a href="{{ route('products-categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    {{-- Display Product Categories data in a table view --}}
                    <table class="table-auto w-full !my-4" id="categories-table">
                        <thead class="">
                            <tr>
                                <th class="px-4 py-2 bg-gray-200 border border-black">ID</th>
                                <th class="px-4 py-2 bg-gray-200 border border-black">Name</th>
                                <th class="px-4 py-2 bg-gray-200 border border-black">Slug</th>
                                <th class="px-4 py-2 bg-gray-200 border border-black">Products Count</th>
                                <th class="px-4 py-2 bg-gray-200 border border-black">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="border px-4 py-2 border-black">{{ $category->id }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $category->name }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $category->slug }}</td>
                                    <td class="border px-4 py-2 border-black">{{ $category->products_count }}</td>
                                    <td class="border px-4 py-2 flex flex-wrap gap-2 items-center border-black">
                                        <a href="{{ route('products-categories.edit', $category->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                                        <form action="{{ route('products-categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>

{{-- Alternatif jika pingin cepet bikin data table, catatan cocok untuk data yg sedikit karena kalau banyak loadnya lama --}}
@push('styles')
    {{-- Data Table js css cdn --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .dataTables_filter{
            margin-bottom: 1rem;
        }
    </style>
@endpush
@push('scripts')
    {{-- Data Table js cdn --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#categories-table').DataTable();
        });
    </script>
@endpush
</x-app-layout>