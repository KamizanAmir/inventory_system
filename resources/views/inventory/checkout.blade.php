<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center">

        <div class="mb-6">
            <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline text-sm font-semibold">
                &larr; Back to Dashboard
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Scan Item</h1>
        <p class="text-gray-500 mb-6">Scan barcode to checkout or return an item.</p>

        <!-- Flash Messages for Success/Error alerts -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- The hidden submit button works alongside the scanner's automatic "Enter" keystroke -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="text" name="sku_label" id="sku_label"
                    class="w-full text-center text-2xl p-4 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    placeholder="e.g. CK-01" autocomplete="off" autofocus required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition duration-200">
                Process Scan
            </button>
        </form>

    </div>

    <!-- Small JavaScript snippet to keep focus on the input so the user can scan rapidly -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('sku_label');
            input.focus();

            // If user clicks anywhere else on the page, force focus back to the input
            document.body.addEventListener('click', function() {
                input.focus();
            });
        });
    </script>
</body>

</html>
