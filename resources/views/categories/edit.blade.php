<x-layout>
    <section class="max-w-4xl p-6 mx-auto rounded-md">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-white capitalize">Edit Category</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="block text-sm font-medium dark:text-white text-gray-700">Category Name</label>
                    <input id="name" name="name" type="text" value="{{ $category->name }}"
                        class="mt-1 block w-full px-3 py-2 bg-white dark:text-black border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium dark:text-white text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 block w-full px-3 py-2 bg-white border dark:text-black border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                        placeholder="Write category description here">{{ $category->description }}</textarea>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-md hover:bg-primary-700 focus:outline-none focus:bg-primary-700">
                    Update Category
                </button>
                <a href="/categories"
                    class="ml-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700">
                    Close
                </a>
            </div>
        </form>
    </section>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            CKEDITOR.replace('description');
        });
    </script> --}}
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</x-layout>
