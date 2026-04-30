<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Scanner Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include the HTML5 QR Code library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center">

        <div class="mb-6 text-left">
            <a href="{{ route('inventory.index') }}" class="text-blue-500 hover:underline text-sm font-semibold">
                &larr; Back to Dashboard
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Scan Item</h1>
        <p class="text-gray-500 mb-6">Use your camera or type the barcode.</p>

        <!-- Flash Messages -->
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

        <!-- The Camera Viewfinder will appear inside this div -->
        <div id="reader" class="w-full mb-6 overflow-hidden rounded-lg border-2 border-gray-200"></div>

        <!-- The Form -->
        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="mb-4">
                <p class="text-sm text-gray-400 mb-2 font-bold uppercase">Or enter manually:</p>
                <input type="text" name="sku_label" id="sku_label"
                    class="w-full text-center text-xl p-3 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500"
                    placeholder="e.g. CK-01" autocomplete="off">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded hover:bg-blue-700 transition duration-200 hidden"
                id="manual-submit">
                Process Manual Entry
            </button>
        </form>

    </div>

    <!-- The Scanning Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputField = document.getElementById('sku_label');
            const manualSubmitBtn = document.getElementById('manual-submit');
            const form = document.getElementById('checkout-form');

            // Show submit button if user starts typing manually
            inputField.addEventListener('input', function() {
                if (this.value.length > 0) {
                    manualSubmitBtn.classList.remove('hidden');
                } else {
                    manualSubmitBtn.classList.add('hidden');
                }
            });

            // What happens when the camera successfully reads a barcode?
            function onScanSuccess(decodedText, decodedResult) {
                // 1. Stop the scanner so it doesn't scan the same item 50 times a second
                html5QrcodeScanner.clear();

                // 2. Put the scanned text into our input field
                inputField.value = decodedText;

                // 3. Automatically submit the form!
                form.submit();
            }

            // Initialize the scanner
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false
            );

            // Render it to the screen
            html5QrcodeScanner.render(onScanSuccess);
        });
    </script>
</body>

</html>
