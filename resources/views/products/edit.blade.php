<x-layout>
    <section class="p-6 sm:p-10 max-w-3xl mx-auto rounded-lg">
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-800 dark:text-white">Edit Product</h2>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 sm:grid-cols-2">
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Title</label>
                    <input type="text" name="title" id="title" value="{{ $product->title }}"
                        class="bg-gray-100 border border-gray-300 text-gray-900 dark:text-black text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ $product->stock }}"
                        class="bg-gray-100 border border-gray-300 text-gray-900 dark:text-black text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Price</label>
                    <input type="number" name="price" id="price" value="{{ $product->price }}"
                        class="bg-gray-100 border border-gray-300 text-gray-900 dark:text-black text-sm rounded-lg block w-full p-3 focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="file_input" class="block mb-2 text-sm font-medium text-gray-700 dark:text-white">Upload New Image
                        (optional)</label>
                    <input
                        class="block w-full text-sm text-gray-900 dark:text-black border border-gray-300 rounded-lg cursor-pointer bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        id="file_input" type="file" name="image">
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-700 dark:text-slate-200">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="block p-3 w-full text-sm text-gray-900 dark:text-black bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update
                    Product</button>
                <a type="button"
                    class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm px-5 py-2.5 ml-2"
                    href="/products">
                    Close
                </a>
            </div>
        </form>
    </section>
</x-layout>
