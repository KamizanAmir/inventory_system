<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Asset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-8">

                <form method="POST" action="{{ route('assets.store') }}" x-data="{ isConsumable: false }">
                    @csrf

                    <!-- Select Category -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Item Category</label>
                        <select name="category_id" id="category_id" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select a category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->prefix }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <!-- Barcode / SKU -->
                    <div class="mb-6">
                        <label for="sku_label" class="block text-sm font-bold text-gray-700 mb-2">Barcode / SKU
                            Label</label>
                        <input type="text" name="sku_label" id="sku_label" placeholder="e.g. CK-05" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 uppercase">
                        <p class="text-xs text-gray-500 mt-1">This is the unique code that will be printed on the
                            sticker.</p>
                        <x-input-error :messages="$errors->get('sku_label')" class="mt-2" />
                    </div>

                    <!-- Consumable Toggle -->
                    <div class="mb-6 p-4 border border-blue-100 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_consumable" id="is_consumable" value="1"
                                x-model="isConsumable"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                            <label for="is_consumable"
                                class="ml-3 block text-sm font-bold text-blue-900 cursor-pointer">
                                This is a Consumable / Bulk Item (e.g. Cables, Batteries)
                            </label>
                        </div>
                        <p class="text-xs text-blue-700 mt-2 ml-8">Check this if people borrow quantities of this item
                            rather than checking out a specific unique tool.</p>
                    </div>

                    <!-- Hidden Fields (Only show if Consumable is checked) -->
                    <div x-show="isConsumable" x-transition class="flex gap-4 mb-6">
                        <div class="w-1/2">
                            <label for="quantity" class="block text-sm font-bold text-gray-700 mb-2">Initial
                                Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="w-1/2">
                            <label for="min_stock_level" class="block text-sm font-bold text-gray-700 mb-2">Minimum
                                Stock Alert Level</label>
                            <input type="number" name="min_stock_level" id="min_stock_level" min="0"
                                value="10"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Warn procurement when stock drops below this.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="bg-gray-900 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-gray-800 transition">
                            Save Item to Inventory
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
