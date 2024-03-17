<x-frontend.layouts.master>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Generate QR Code</h1>
        <div class="flex flex-col md:flex-row">
            <div class="mb-4 md:mr-4 w-full md:w-2/3"> <!-- Adjusted width -->
                <label for="text" class="block text-sm font-medium text-gray-600">Text to Encode</label>
                <textarea type="text" id="text" class="mt-1 p-2 border rounded-md w-4/5 min-h-28 overflow-hidden" placeholder="Enter text"></textarea>
            </div>
    
            <div id="qrcode" class="w-full md:w-1/3"></div> <!-- Adjusted width -->
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <script>
            // Function to update the QR code when the input changes
            function updateQRCode(text) {
                const qrcodeElement = document.getElementById('qrcode');

                // Clear the previous QR code
                qrcodeElement.innerHTML = '';

                // Generate a new QR code
                const qrcode = new QRCode(qrcodeElement, {
                    text: text,
                    width: 250,
                    height: 250
                    // Add more options as needed
                });
            }

            // Add an event listener for the input field
            document.getElementById('text').addEventListener('input', function() {
                updateQRCode(this.value);
            });

            // Initial QR code generation with a default value
            updateQRCode('Micro Needs - QR Code Generator');
        </script>
    @endpush
</x-frontend.layouts.master>
