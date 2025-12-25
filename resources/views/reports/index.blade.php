@extends('layout')

@section('content')
    <style>
        @media print {
            nav, footer, .no-print { display: none !important; }
            body { background: white; }
            .print-container { padding: 0; margin: 0; width: 100%; }
            .shadow-lg { box-shadow: none !important; border: 1px solid #ddd; }
        }
    </style>

    <div class="max-w-7xl mx-auto mt-6 print-container">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 no-print">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Laporan Inventaris</h1>
                <p class="text-gray-500 text-sm">Ringkasan statistik dan daftar stok barang.</p>
            </div>
            <button onclick="window.print()" class="flex items-center gap-2 bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-5 rounded-lg transition shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 no-print">
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Jenis Barang</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Stok Fisik</p>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalStock) }}</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Stok Menipis (<=10)</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $lowStock }}</p>
                </div>
            </div>

             <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Stok Habis</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $outOfStock }}</p>
                </div>
            </div>
        </div>

        <div class="hidden print:block mb-8 border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Laporan Stok Gudang</h1>
            <p class="text-gray-600">Dicetak pada: {{ date('d F Y, H:i') }}</p>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-200 bg-gray-50 no-print">
                <h3 class="font-bold text-gray-700">Detail Semua Barang</h3>
            </div>
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama Barang</th>
                        <th class="px-6 py-3 text-center">Stok</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($products as $index => $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium">{{ $index + 1 }}</td>
                        <td class="px-6 py-3 font-bold text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->stock }}</td>
                        <td class="px-6 py-3 truncate max-w-xs">{{ $product->description ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">
                            @if($product->stock == 0)
                                <span class="text-red-600 font-bold">Habis</span>
                            @elseif($product->stock <= 10)
                                <span class="text-yellow-600 font-bold">Menipis</span>
                            @else
                                <span class="text-green-600 font-bold">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="hidden print:block mt-8 text-right text-xs text-gray-500">
            <p>Dokumen ini dibuat otomatis oleh Sistem Gudang.</p>
        </div>
    </div>
@endsection