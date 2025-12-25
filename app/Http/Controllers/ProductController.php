<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload ke MinIO (S3)
        $path = $request->file('image')->store('products', 's3');

        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_path' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'stock', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama di MinIO
            if ($product->image_path) {
                Storage::disk('s3')->delete($product->image_path);
            }
            // Upload baru
            $data['image_path'] = $request->file('image')->store('products', 's3');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Barang berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar di MinIO
        if ($product->image_path) {
            Storage::disk('s3')->delete($product->image_path);
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang dihapus');
    }
}