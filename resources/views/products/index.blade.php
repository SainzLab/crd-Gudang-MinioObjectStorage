@extends('layout')

@section('content')
    <div class="max-w-7xl mx-auto mt-10">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 tracking-tight">Gudang Utama</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola stok dan inventaris barang Anda.</p>
            </div>
            
            <div class="flex gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" placeholder="Cari barang..." class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                </div>

                <a href="{{ route('products.create') }}" class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold tracking-wider">Produk</th>
                            <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Status Stok</th>
                            <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Jumlah</th>
                            <th scope="col" class="px-6 py-4 font-bold tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                        <tr class="hover:bg-blue-50 transition duration-150 ease-in-out group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        @if($product->image_path)
                                            <img class="h-16 w-16 rounded-lg object-cover border border-gray-200 shadow-sm" src="{{ Storage::disk('s3')->url($product->image_path) }}" alt="{{ $product->name }}">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-base font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500 max-w-xs truncate">{{ Str::limit($product->description, 40) ?? 'Tidak ada deskripsi' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($product->stock > 10)
                                    <span class="px-3 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full border border-green-200">
                                        Tersedia
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="px-3 py-1 text-xs font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full border border-yellow-200">
                                        Menipis
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full border border-red-200">
                                        Habis
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center font-medium text-gray-700">
                                {{ $product->stock }} unit
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('products.edit', $product->id) }}" class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-100 rounded-full transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    
                                    {{-- Delete Button --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(this)" class="p-2 text-red-600 hover:text-red-900 hover:bg-red-100 rounded-full transition" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- Empty State (Jika tidak ada data) --}}
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada barang</h3>
                                    <p class="text-gray-500 mb-4">Gudang Anda masih kosong. Silakan tambah barang baru.</p>
                                    <a href="{{ route('products.create') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                        + Tambah Barang Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">Menampilkan seluruh data gudang</p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(button) {
            const form = button.closest('.delete-form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',   
                cancelButtonColor: '#3085d6', 
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true 
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection