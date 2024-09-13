<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class ProductController extends Controller
{
    // menampilkan semua product
    public function index()
    {
        $products = Product::latest()->paginate(10);

        $categories = Category::all();
        // menampilkan view index
        // compact : mengirimkan data ke view
        return view('products/index', compact('products' , 'categories'));
    }

    // metode untuk menghapus produk berdasarkan id
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            Storage::delete('public/products/' . $product->image);
            $product->delete();
            return response()->json(['success' => 'Produk berhasil dihapus.']);
        }
        return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
    }

    public function create(): view
    {
         // Mengembalikan tampilan untuk membuat produk baru
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|',
            'category_id'   => 'required|',
            'description'   => 'required|min:5',
            'price'         => 'required|numeric|max:99999999',
            'stock'         => 'required|numeric|max:99999999'
        ]);


        // Upload gambar
        $image = $request->file('image');  // Mengambil file gambar dari request
        $image->storeAs('public/products', $image->hashName()); // Menyimpan gambar ke direktori 'public/products' dengan nama hash


        // Membuat produk baru
        Product::create([
            'image'         => $image->hashName(), // Menyimpan nama hash gambar ke kolom 'image'
            'title'         => $request->title, // Menyimpan judul produk dll
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);


        //redirect to index
        session()->flash('success', 'Product added successfully!'); // Use flash data

        return redirect()->route('products.index');
    }



    public function show(string $id): View
    {

        //ambil product berdasarkan id yang ada
        $product = Product::findOrFail($id);

        //mengirimkan data product ke view
        return view('products/show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi data permintaan yang masuk
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Gambar opsional, harus berupa file gambar dengan tipe jpeg, jpg, atau png, dan ukuran maksimal 2048 KB
            'title' => 'required|string|max:255', // Judul wajib, harus berupa string, dan maksimal 255 karakter
            'description' => 'required|min:5', // Deskripsi wajib, minimal 5 karakter
            'price' => 'required|numeric', // Harga wajib, harus berupa angka
            'stock' => 'required|numeric' // Stok wajib, harus berupa angka
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Perbarui detail produk
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Tangani unggahan gambar jika ada gambar baru yang disediakan
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::delete('public/products/' . $product->image);
            }

            // Simpan gambar baru
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $product->image = $image->hashName();
        }

        // Simpan produk yang telah diperbarui
        $product->save();

        // Arahkan kembali ke indeks produk dengan pesan sukses
        return redirect()->route('products.index')->with(['success' => 'Produk berhasil diperbarui!']);
    }





}
