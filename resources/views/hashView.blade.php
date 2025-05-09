<x-frontend.layouts.master>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hashing Tool') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">MD5 Hash Generator</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Hash Generator Section -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                    </svg>
                                    Generate Hash
                                </h3>
                                
                                <form id="encryptForm" class="space-y-4">
                                    <div>
                                        <label for="encryptInput" class="block text-sm font-medium text-gray-700 mb-1">
                                            Enter text to hash
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" name="encrypt" id="encryptInput" 
                                                class="focus:ring-green-500 focus:border-green-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300 p-3 border"
                                                placeholder="Type something..." required>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                        Generate MD5 Hash
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Results Card -->
                            <div id="resultsCard" class="bg-gray-50 p-6 rounded-lg border border-gray-200 hidden">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                    </svg>
                                    Hash Results
                                </h3>
                                
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Original Text</p>
                                        <div class="mt-1 p-3 bg-gray-100 rounded-md text-sm font-mono" id="plainTextEnc"></div>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">MD5 Hash</p>
                                        <div class="mt-1 flex items-center">
                                            <div class="flex-1 p-3 bg-gray-100 rounded-md text-sm font-mono break-all" id="md5HashEnc"></div>
                                            <button id="copyButtonEnc" class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                Copy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Information Section -->
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                                </svg>
                                About MD5 Hashing
                            </h3>
                            
                            <div class="prose prose-sm text-gray-600">
                                <p>MD5 (Message Digest Algorithm 5) is a widely-used cryptographic hash function that produces a 128-bit (16-byte) hash value.</p>
                                
                                <div class="mt-4 p-3 bg-blue-100 rounded-md border border-blue-200">
                                    <h4 class="font-medium text-blue-800">Important Notes:</h4>
                                    <ul class="list-disc pl-5 space-y-1 mt-2">
                                        <li>MD5 is a one-way hashing function - it cannot be decrypted</li>
                                        <li>While fast, MD5 is not considered secure for cryptographic purposes</li>
                                        <li>Commonly used for checksums and non-security applications</li>
                                        <li>Produces a 32-character hexadecimal number</li>
                                    </ul>
                                </div>
                                
                                <div class="mt-4">
                                    <h4 class="font-medium text-gray-700">Example Hashes:</h4>
                                    <div class="mt-2 space-y-1 text-sm font-mono">
                                        <p>"hello" → <span class="text-blue-600">5d41402abc4b2a76b9719d911017c592</span></p>
                                        <p>"password" → <span class="text-blue-600">5f4dcc3b5aa765d61d8327deb882cf99</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const encryptForm = document.getElementById('encryptForm');
                const resultsCard = document.getElementById('resultsCard');
                const plainTextEnc = document.getElementById('plainTextEnc');
                const md5HashEnc = document.getElementById('md5HashEnc');
                const copyButtonEnc = document.getElementById('copyButtonEnc');
                const originalCopyText = copyButtonEnc.innerHTML;

                encryptForm.addEventListener('submit', encryptData);
                copyButtonEnc.addEventListener('click', copyText);

                function encryptData(event) {
                    event.preventDefault();
                    const rawData = document.getElementById('encryptInput').value.trim();
                    
                    if (!rawData) return;
                    
                    axios.post('{{ route('hash.encrypt') }}', {
                            encrypt: rawData
                        })
                        .then(function(response) {
                            plainTextEnc.textContent = rawData;
                            md5HashEnc.textContent = response.data.encrypted_data;
                            resultsCard.classList.remove('hidden');
                            
                            // Reset copy button text if it was changed
                            copyButtonEnc.innerHTML = originalCopyText;
                        })
                        .catch(function(error) {
                            console.error(error);
                            alert('An error occurred while generating the hash');
                        });
                }

                function copyText() {
                    const textToCopy = md5HashEnc.textContent;
                    
                    navigator.clipboard.writeText(textToCopy)
                        .then(() => {
                            copyButtonEnc.innerHTML = 'Copied!';
                            setTimeout(() => {
                                copyButtonEnc.innerHTML = originalCopyText;
                            }, 2000);
                        })
                        .catch(err => {
                            console.error('Failed to copy: ', err);
                            copyButtonEnc.innerHTML = 'Failed';
                            setTimeout(() => {
                                copyButtonEnc.innerHTML = originalCopyText;
                            }, 2000);
                        });
                }
            });
        </script>
    @endpush
</x-frontend.layouts.master>