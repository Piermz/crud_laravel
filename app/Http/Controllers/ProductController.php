<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use Illuminate\View\view;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    // menampilkan semua product
    public function index()
    {
        $products = Product::latest()->paginate(10);


        // menampilkan view index
        // compact : mengirimkan data ke view
        return view('products/index', compact('products'));
    }

    // metode untuk menghapus produk berdasarkan id
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['success' => 'Produk berhasil dihapus.']);
        }
        return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
    }

    public function create(): view
    {
        return view('products.create');
    }

    // public function store(Request $request): RedirectResponse
    // {

    //     // Request : objek yang mengandung semua data yang dikirimkan oleh pengguna melalui formulir atau URL

    //     // $request : untuk mengakses data yang dikirimkan oleh pengguna

    //     // RedirectResponse : digunakan untuk mengarahkan kembali ke halaman lain atau ke daftar data setelah data baru berhasil disimpan
    //     // Validasi input
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'stock' => 'required|integer',
    //         'price' => 'required|numeric',
    //         'description' => 'nullable|string',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
    //     ]);

    //     // Simpan produk baru
    //     // $product = new Product();
    //     // $product->name = $request->title; // Menggunakan title sebagai nama produk
    //     // $product->stock = $request->stock;
    //     // $product->price = $request->price;
    //     // $product->description = $request->description;

    //     $image = $request->file('image');
    //     $image->storeAs('public/products', $image->hashName());

    //     //create product
    //     Product::create([
    //         'image' => $image->hashName(),
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'price' => $request->price,
    //         'stock' => $request->stock
    //     ]);



    //     // hashName, metode yang digunakan dalam konteks upload file untuk menghasilkan nama file yang unik dan aman, fitur ini biasanya digunakan dalam sistem upload file untuk menghindari konflik nama file dan untuk memastikan bahwa file yang di-upload tidak akan menimpa file lainnya.


    //     // Menangani upload gambar
    //     // if ($request->hasFile('image')) {
    //     //     $imagePath = $request->file('image')->store('images', 'public');
    //     //     $product->image = $imagePath; // Simpan path gambar
    //     // }

    //     // $product->save();

    //     return redirect()->route('products.index');
    // }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|',
            'description'   => 'required|min:5',
            'price'         => 'required|numeric|max:99999999',
            'stock'         => 'required|numeric|max:99999999'
        ]);


        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());


        //create product
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);


        //redirect to index
        session()->flash('success', 'Product added successfully!'); // Use flash data

        return redirect()->route('products.index');
    }



    public function show(string $id): View {

        //ambil product berdasarkan id yang ada
        $product = Product::findOrFail($id);

        //mengirimkan data product ke view
        return view('products/show', compact('product'));
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update product details
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());
            $product->image = $image->hashName();
        }

        // Save the updated product
        $product->save();

        // Redirect back to the products index with a success message
        return redirect()->route('products.index')->with(['success' => 'Produk berhasil diperbarui!']);
    }

    public function destroyAll()
    {
        // Optionally check for authorization
        // $this->authorize('delete', Product::class);

        // Delete all products
        Product::query()->delete(); // Use delete() instead of truncate() if there are foreign key constraints

        return response()->json(['message' => 'All products deleted successfully.'], 200);
    }
}
