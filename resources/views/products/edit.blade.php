<x-layout>
    <section class="p-3 sm:p-5 max-w-2xl mx-auto">
        <h2 class="text-xl font-semibold text-center mb-5">Edit Product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium">Title</label>
                    <input type="text" name="title" id="title" value="{{ $product->title }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div>
                    <label for="stock" class="block mb-2 text-sm font-medium">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ $product->stock }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium">Price</label>
                    <input type="number" name="price" id="price" value="{{ $product->price }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div>
                    <label for="file_input" class="block mb-2 text-sm font-medium">Upload New Image (optional)</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="file_input" type="file" name="image">
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"
                        placeholder="Write product description here">{{ $product->description }}
                    </textarea>

                </div>
            </div>
            <button type="submit"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 font-medium rounded-lg text-sm px-5 py-2.5">
                Update Product
            </button>
            <button type="button"
                class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 ml-2"
                onclick="window.history.back();">
                Close
            </button>
        </form>
    </section>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     CKEDITOR.replace('description');
        // });
    </script>
</x-layout>
