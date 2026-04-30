<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8 border-t-4 border-blue-500">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Category Details</h3>
                    <p class="text-sm text-gray-500">Create a new category to group your assets and define their barcode
                        prefix.</p>
                </div>

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <!-- Category Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Category Name</label>
                        <input type="text" name="name" id="name" placeholder="e.g. Safety Helmet" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Category Prefix -->
                    <div class="mb-8">
                        <label for="prefix" class="block text-sm font-bold text-gray-700 mb-2">Barcode Prefix</label>
                        <input type="text" name="prefix" id="prefix" placeholder="e.g. SH" required
                            maxlength="5"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 uppercase">
                        <p class="text-xs text-gray-500 mt-2">A short 2-4 letter code used to generate barcodes (e.g.,
                            <strong>SH</strong>-01).</p>
                        <x-input-error :messages="$errors->get('prefix')" class="mt-2 text-red-600 text-sm" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-blue-700 transition">
                            Save Category
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
