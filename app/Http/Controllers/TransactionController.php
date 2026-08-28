<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan Halaman Laporan & Riwayat Transaksi dari DB
    public function index()
    {
        $transactions = Transaction::with('product')->latest()->get();
        $totalPendapatan = Transaction::where('status', 'Lunas')->sum('total_price');
        $transaksiSelesai = Transaction::where('status', 'Lunas')->count();

        return view('reports', compact('transactions', 'totalPendapatan', 'transaksiSelesai'));
    }

    // Menampilkan Form Tambah Transaksi
    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('create-transaction', compact('products'));
    }

    // Menyimpan Transaksi & Mengurangi Stok Produk Otomatis
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:Cash,QRIS,Transfer',
            'status' => 'required|in:Lunas,Pending,Batal'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok produk tidak mencukupi! Sisa stok: ' . $product->stock);
        }

        // Potong Stok Produk
        $product->decrement('stock', $request->quantity);

        // Hitung Total harga
        $totalPrice = $product->price * $request->quantity;

        // Simpan Transaksi
        Transaction::create([
            'trx_id' => 'TRX-' . rand(1000, 9999),
            'customer_name' => $request->customer_name,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);

        return redirect('/reports')->with('success', 'Transaksi berhasil dibuat dan stok produk telah berkurang!');
    }

    // Update Status Transaksi dari Reports
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Lunas,Pending,Batal']);
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $request->status]);

        return back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}