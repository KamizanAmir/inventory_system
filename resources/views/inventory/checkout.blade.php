<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Scanner Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md text-center">

        <div class="mb-6 text-left">
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline text-sm font-semibold">
                &larr; Back to Dashboard
            </a>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Scan Item</h1>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Error!</strong> {{ session('error') }}
            </div>
        @endif

        <!-- Camera Viewfinder -->
        <div id="reader"
            class="w-full mb-4 overflow-hidden rounded-lg border-2 border-gray-200 bg-black min-h-[250px] flex items-center justify-center">
            <span class="text-white text-sm" id="camera-status">Camera off</span>
        </div>

        <!-- NEW: Explicit Button to trigger camera -->
        <button type="button" id="start-camera-btn"
            class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded hover:bg-green-700 transition duration-200 mb-6 shadow-md">
            📸 Tap to Open Camera
        </button>

        <!-- The Form -->
        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="mb-4">
                <div class="mb-4 flex space-x-2">
                    <div class="w-1/3">
                        <p class="text-xs text-gray-500 mb-1 font-bold uppercase text-left">Qty (Consumables)</p>
                        <input type="number" name="quantity" id="quantity" value="1" min="1"
                            class="w-full text-center text-xl p-3 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="w-2/3">
                        <p class="text-xs text-gray-500 mb-1 font-bold uppercase text-left">Barcode / SKU</p>
                        <input type="text" name="sku_label" id="sku_label"
                            class="w-full text-center text-xl p-3 border-2 border-gray-300 rounded focus:outline-none focus:border-blue-500"
                            placeholder="e.g. CK-01" autocomplete="off">
                    </div>
                </div>
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

    <!-- Revised JavaScript Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputField = document.getElementById('sku_label');
            const manualSubmitBtn = document.getElementById('manual-submit');
            const form = document.getElementById('checkout-form');
            const startBtn = document.getElementById('start-camera-btn');
            const statusText = document.getElementById('camera-status');

            // Show submit button if user types manually
            inputField.addEventListener('input', function() {
                if (this.value.length > 0) {
                    manualSubmitBtn.classList.remove('hidden');
                } else {
                    manualSubmitBtn.classList.add('hidden');
                }
            });

            // We use the lower-level Html5Qrcode class to bypass the default UI
            const html5QrCode = new Html5Qrcode("reader");

            startBtn.addEventListener('click', () => {
                statusText.style.display = 'none';
                startBtn.innerText = "Requesting Permission...";

                // Start the camera specifically requesting the back camera ("environment")
                html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        }
                    },
                    (decodedText, decodedResult) => {
                        // ON SUCCESS:
                        html5QrCode.stop().then(() => {
                            inputField.value = decodedText;
                            form.submit();
                        });
                    },
                    (errorMessage) => {
                        // Frame errors happen multiple times a second, we ignore them
                    }
                ).then(() => {
                    // Camera started successfully
                    startBtn.innerText = "Scanning... Point at barcode";
                    startBtn.classList.replace('bg-green-600', 'bg-gray-500');
                    startBtn.disabled = true;
                }).catch((err) => {
                    // If the browser STILL blocks it, it will tell us exactly why here!
                    alert("Camera Error: " + err);
                    startBtn.innerText = "📸 Tap to Open Camera";
                    statusText.style.display = 'block';
                });
            });
        });
    </script>
</body>

</html>
