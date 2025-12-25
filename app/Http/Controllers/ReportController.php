<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $lowStock = Product::where('stock', '<=', 10)->count();
        $outOfStock = Product::where('stock', 0)->count();

        $products = Product::orderBy('name', 'asc')->get();

        return view('reports.index', compact(
            'totalProducts', 
            'totalStock', 
            'lowStock', 
            'outOfStock',
            'products'
        ));
    }
}
