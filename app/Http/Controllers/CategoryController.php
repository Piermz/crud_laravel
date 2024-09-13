<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'description'   => 'required|min:5',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the incoming request data
        $request->validate([
            'name'         => 'required',
            'description'  => 'required|min:5',
        ]);

        // Find the product by ID
        $category = Category::findOrFail($id);

        // Update product details
        $category->name = $request->name;
        $category->description = $request->description;

        // Save the updated product
        $category->save();

        // Redirect back to the products index with a success message
        return redirect()->route('categories.index')->with(['success' => 'Produk berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return response()->json(['success' => 'Produk berhasil dihapus.']);
        }
        return response()->json(['error' => 'Produk tidak ditemukan.'], 404);
    }
}
