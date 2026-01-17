@extends('backend.layouts.app')

@section('header', 'Tambah Produk')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">Produk Baru</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Informasi produk baru yang akan ditambahkan
                </p>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded relative" role="alert">
                                @foreach ($errors->all() as $error)
                                    <span class="block sm:inline">{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                            </div>

                            <div class="col-span-6">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select id="category_id" name="category_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea id="description" name="description" rows="4" required
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="base_price" class="block text-sm font-medium text-gray-700">Harga Dasar</label>
                                <input type="number" name="base_price" id="base_price" value="{{ old('base_price') }}" step="0.01" min="0" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                            </div>

                            <div class="col-span-6">
                                <label for="image" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                                <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>

                            <div class="col-span-6">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="is_active" name="is_active" type="checkbox" value="1" checked
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="is_active" class="font-medium text-gray-700">Aktif</label>
                                        <p class="text-gray-500">Produk akan ditampilkan di frontend</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="allow_custom" name="allow_custom" type="checkbox" value="1" checked
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_custom" class="font-medium text-gray-700">Izinkan Custom</label>
                                        <p class="text-gray-500">Produk dapat dicustom oleh customer</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Custom Options</label>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <input id="custom_text" name="custom_options[]" value="custom_text" type="checkbox" 
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                        <label for="custom_text" class="ml-2 text-sm text-gray-700">Custom Text</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="custom_size" name="custom_options[]" value="custom_size" type="checkbox"
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                        <label for="custom_size" class="ml-2 text-sm text-gray-700">Custom Size</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="custom_color" name="custom_options[]" value="custom_color" type="checkbox"
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                        <label for="custom_color" class="ml-2 text-sm text-gray-700">Custom Color</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="upload_logo" name="custom_options[]" value="upload_logo" type="checkbox"
                                               class="h-4 w-4 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                        <label for="upload_logo" class="ml-2 text-sm text-gray-700">Upload Logo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-yellow-500 py-2 px-4 text-sm font-medium text-gray-900 shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:ml-3">
                            Simpan
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 sm:ml-3">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
