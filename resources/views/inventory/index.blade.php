<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Main Inventory</h1>
            <a href="{{ route('checkout.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
                Scan / Checkout Item
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full text-left">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3">Label (SKU)</th>
                        <th class="px-6 py-3">Item Name</th>
                        <th class="px-6 py-3">Condition</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Location / User</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($assets as $asset)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold">{{ $asset->sku_label }}</td>
                            <td class="px-6 py-4">{{ $asset->category->name }}</td>

                            <!-- Highlight Condition -->
                            <td class="px-6 py-4">
                                @if ($asset->condition == 'Good')
                                    <span class="text-green-600 font-semibold">{{ $asset->condition }}</span>
                                @else
                                    <span class="text-red-600 font-semibold">{{ $asset->condition }}</span>
                                @endif
                            </td>

                            <!-- Highlight Status -->
                            <td class="px-6 py-4">
                                @if ($asset->status == 'In Store')
                                    <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">In
                                        Store</span>
                                @elseif($asset->status == 'Loaned')
                                    <span
                                        class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Loaned</span>
                                @else
                                    <span
                                        class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">{{ $asset->status }}</span>
                                @endif
                            </td>

                            <!-- Show Location if Loaned -->
                            <td class="px-6 py-4">
                                @if ($asset->activeLoan)
                                    {{ $asset->activeLoan->location_notes ?? 'Unknown Location' }}
                                    <br><span class="text-sm text-gray-500">(Borrowed by:
                                        {{ $asset->activeLoan->user->name ?? 'User' }})</span>
                                @else
                                    Store Room
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
