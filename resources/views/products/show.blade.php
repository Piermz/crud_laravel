<x-layout>

    @section('content')
        <section class="py-8 md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        <img class="h-auto max-w-lg rounded-lg shadow-lg"
                            src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                    </div>

                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        <h1 class="text-2xl font-semibold text-gray-900 sm:text-3xl dark:text-white">
                            {{ $product->title }}
                        </h1>
                        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                            <p class="text-3xl font-extrabold text-gray-900 sm:text-4xl dark:text-white">
                                {{ 'Rp' . number_format($product->price, 0, ',') }}
                            </p>

                            <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                <p class="text-sm font-medium leading-none text-gray-900 dark:text-white">
                                    {{ $product->stock }} in Stock
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                            <a href="{{ route('products.index') }}" title=""
                                class="flex items-center justify-center py-3 px-6 text-sm font-medium text-white bg-red-600 rounded-lg border border-red-600 hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-700 transition duration-300 ease-in-out transform hover:scale-105">
                                Back to Products
                            </a>
                        </div>
                        <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ $product->description }}.
                            <span class="font-bold">{{ $product->updated_at->diffForHumans() }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </x-layout>
