<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Main Inventory') }}
            </h2>
            <a href="{{ route('checkout.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md shadow hover:bg-blue-700 transition flex items-center gap-2 text-sm">
                <!-- Barcode Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z" />
                </svg>
                Scan / Checkout
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <!-- Your exact table code goes here, but without the html/body tags! -->
                <table class="min-w-full text-left">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Label (SKU)</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Item Name</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Condition / Qty</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-sm font-semibold uppercase tracking-wider">Location / User</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                        @foreach ($assets as $asset)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold">{{ $asset->sku_label }}</td>
                                <td class="px-6 py-4">{{ $asset->category->name }}</td>

                                <td class="px-6 py-4">
                                    @if ($asset->is_consumable)
                                        <span class="text-blue-600 font-bold">{{ $asset->quantity }} Units Left</span>
                                    @else
                                        @if ($asset->condition == 'Good')
                                            <span class="text-green-600 font-semibold">{{ $asset->condition }}</span>
                                        @else
                                            <span class="text-red-600 font-semibold">{{ $asset->condition }}</span>
                                        @endif
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if ($asset->status == 'In Store')
                                        <span
                                            class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-xs font-bold border border-green-200">In
                                            Store</span>
                                    @elseif($asset->status == 'Loaned')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-xs font-bold border border-yellow-200">Loaned</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-xs font-bold border border-red-200">{{ $asset->status }}</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if ($asset->activeLoan)
                                        {{ $asset->activeLoan->location_notes ?? 'Unknown Location' }}
                                        <br><span class="text-xs text-gray-500 font-semibold">(By:
                                            {{ $asset->activeLoan->user->name ?? 'User' }})</span>
                                    @else
                                        <span class="text-gray-400 italic">Store Room</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
