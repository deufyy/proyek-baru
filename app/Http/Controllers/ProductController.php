<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('inventory', compact('products'));
    }

    public function create()
    {
        return view('create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock ?? 1, // Otomatis bernilai 1 jika tidak diisi
            'category'    => $request->category ?? 'Console PS',
            'description' => $request->description,
        ]);

        return redirect('/inventory')->with('success', 'Unit PS berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock ?? 1,
            'category'    => $request->category ?? 'Console PS',
            'description' => $request->description,
        ]);

        return redirect('/inventory')->with('success', 'Unit PS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/inventory')->with('success', 'Unit PS berhasil dihapus!');
    }
}