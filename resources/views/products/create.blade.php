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
                <h2 class="text-2xl font-bold text-gray-800">Tambah Barang Baru</h2>
                <p class="text-gray-500 text-sm">Masukan informasi detail barang untuk disimpan ke gudang.</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-8">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Barang</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <input type="text" name="name" placeholder="Contoh: Kursi Gaming" 
                                       class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            </div>
                        </div>

                        <div class="col-span-1">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Stok Awal</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                </div>
                                <input type="number" name="stock" placeholder="0" 
                                       class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" placeholder="Jelaskan kondisi atau detail barang..." 
                                  class="w-full p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none"></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-semibold mb-2">Upload Gambar</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-blue-500 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span></p>
                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                                </div>
                                <input id="dropzone-file" name="image" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-lg text-gray-600 bg-gray-100 hover:bg-gray-200 font-medium transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-bold shadow-lg hover:shadow-blue-500/30 transition duration-200 transform hover:-translate-y-0.5">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const fileInput = document.getElementById('dropzone-file');
        const fileLabel = document.querySelector('label[for="dropzone-file"] p span');

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                fileLabel.textContent = "File dipilih: " + e.target.files[0].name;
                fileLabel.parentElement.classList.add('text-blue-600');
            }
        });
    </script>
@endsection