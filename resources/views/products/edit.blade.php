@extends('layout')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('products.index') }}" class="p-2 rounded-full bg-white text-gray-600 shadow hover:bg-gray-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Barang</h2>
                <p class="text-gray-500 text-sm">Perbarui informasi barang <span class="font-semibold text-blue-600">{{ $product->name }}</span>.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Barang</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            </div>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Stok</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                </div>
                                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                                       class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            </div>
                            @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-8 bg-gray-50 p-6 rounded-xl border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-2">Gambar Saat Ini</label>
                                @if($product->image_path)
                                    <div class="relative group w-full h-48 rounded-lg overflow-hidden border border-gray-300 bg-white">
                                        <img src="{{ Storage::disk('s3')->url($product->image_path) }}" class="w-full h-full object-contain">
                                        <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 text-white text-xs px-2 py-1 w-full text-center">
                                            Tersimpan di MinIO
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center justify-center w-full h-48 bg-gray-200 rounded-lg text-gray-500 border border-gray-300">
                                        <span class="text-sm italic">Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="block text-gray-700 text-sm font-semibold mb-2">
                                    Ganti Gambar <span class="text-gray-400 font-normal">(Opsional)</span>
                                </label>
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-blue-50 hover:border-blue-500 transition duration-300">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-semibold">Klik untuk ganti</span></p>
                                        <p class="text-xs text-gray-400" id="file-name-display">Biarkan kosong jika tetap</p>
                                    </div>
                                    <input id="dropzone-file" name="image" type="file" class="hidden" />
                                </label>
                                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-lg text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-bold shadow-lg hover:shadow-blue-500/30 transition duration-200 transform hover:-translate-y-0.5">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('dropzone-file');
        const fileDisplay = document.getElementById('file-name-display');

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                fileDisplay.textContent = "File baru: " + e.target.files[0].name;
                fileDisplay.classList.add('text-blue-600', 'font-semibold');
                fileDisplay.classList.remove('text-gray-400');
            }
        });
    </script>
@endsection