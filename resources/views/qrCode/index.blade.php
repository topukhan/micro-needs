<x-frontend.layouts.master>
    <div class="max-w-4xl mx-auto mt-8 sm:mt-12 p-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold">QR Code Generator</h1>
                        <p class="text-blue-100 mt-1">Convert any text or URL into a QR code instantly</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Input Section -->
                    <div class="flex-1">
                        <div class="space-y-4">
                            <div>
                                <label for="text" class="block text-sm font-medium text-gray-700 mb-1">Enter Text or URL</label>
                                <textarea id="text" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="https://example.com or any text you want to encode"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size (px)</label>
                                    <select id="size" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="150">150</option>
                                        <option value="200" selected>200</option>
                                        <option value="250">250</option>
                                        <option value="300">300</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                                    <select id="color" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="#000000" selected>Black</option>
                                        <option value="#2563eb">Blue</option>
                                        <option value="#dc2626">Red</option>
                                        <option value="#16a34a">Green</option>
                                    </select>
                                </div>
                            </div>

                            <div class="pt-2">
                                <button id="generateBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Generate QR Code
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Output Section -->
                    <div class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-gray-200 rounded-xl p-6 bg-gray-50 min-h-64">
                        <div id="qrcode" class="mb-4 flex items-center justify-center"></div>
                        <div id="downloadSection" class="hidden text-center">
                            <p class="text-sm text-gray-500 mb-3">Right-click to save or use the button below</p>
                            <button id="downloadBtn" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download QR Code
                            </button>
                        </div>
                        <p id="placeholderText" class="text-gray-400 text-center">Your QR code will appear here</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Usage Tips Section -->
        <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    QR Code Usage Tips
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-medium text-blue-800 mb-2">Best Practices</h3>
                        <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                            <li>For URLs, always include "https://"</li>
                            <li>Test your QR code after generation</li>
                            <li>Larger sizes work better for printing</li>
                        </ul>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-medium text-green-800 mb-2">Common Uses</h3>
                        <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
                            <li>Website links</li>
                            <li>Contact information</li>
                            <li>Wi-Fi network credentials</li>
                            <li>Product information</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const textInput = document.getElementById('text');
                const sizeSelect = document.getElementById('size');
                const colorSelect = document.getElementById('color');
                const generateBtn = document.getElementById('generateBtn');
                const downloadBtn = document.getElementById('downloadBtn');
                const qrcodeElement = document.getElementById('qrcode');
                const downloadSection = document.getElementById('downloadSection');
                const placeholderText = document.getElementById('placeholderText');
                
                let currentQRCode = null;

                // Initialize with default values
                updateQRCode('Micro Needs - QR Code Generator', sizeSelect.value, colorSelect.value);

                // Generate button click handler
                generateBtn.addEventListener('click', function() {
                    const text = textInput.value.trim();
                    if (!text) {
                        alert('Please enter some text or URL to generate QR code');
                        return;
                    }
                    updateQRCode(text, sizeSelect.value, colorSelect.value);
                });

                // Update QR code function
                function updateQRCode(text, size = 200, color = '#000000') {
                    // Clear previous QR code
                    qrcodeElement.innerHTML = '';
                    
                    if (currentQRCode) {
                        currentQRCode.clear();
                    }

                    // Generate new QR code
                    currentQRCode = new QRCode(qrcodeElement, {
                        text: text,
                        width: parseInt(size),
                        height: parseInt(size),
                        colorDark: color,
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });

                    // Show download section and hide placeholder
                    downloadSection.classList.remove('hidden');
                    placeholderText.classList.add('hidden');
                }

                // Download button click handler
                downloadBtn.addEventListener('click', function() {
                    if (!currentQRCode) return;
                    
                    const canvas = qrcodeElement.querySelector('canvas');
                    if (!canvas) return;
                    
                    const link = document.createElement('a');
                    link.download = 'qr-code.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                });

                // Auto-generate on input change (with debounce)
                let debounceTimer;
                textInput.addEventListener('input', function() {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        const text = textInput.value.trim();
                        if (text.length > 0) {
                            updateQRCode(text, sizeSelect.value, colorSelect.value);
                        }
                    }, 500);
                });

                // Update QR code when size or color changes
                sizeSelect.addEventListener('change', updateFromControls);
                colorSelect.addEventListener('change', updateFromControls);

                function updateFromControls() {
                    const text = textInput.value.trim() || 'Micro Needs - QR Code Generator';
                    updateQRCode(text, sizeSelect.value, colorSelect.value);
                }
            });
        </script>
    @endpush
</x-frontend.layouts.master>