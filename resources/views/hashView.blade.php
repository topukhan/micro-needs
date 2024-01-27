<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hashing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Hash ENC/DEC') }}
                </div>
            </div>
        </div> --}}

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <!-- Encryption Section -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <form id="encryptForm">
                                {{-- @csrf --}}
                                <label for="encryptInput"
                                    class="block uppercase tracking-wide text-gray-700 font-bold mb-2"
                                    for="grid-password">
                                    Make Hash (MD5)
                                </label>
                                <input type="text" name="encrypt" id="encryptInput"
                                    class="w-3/4 focus:border-green-600 focus:ring-green-500" required>
                                <button type="submit"
                                    class="bg-green-500 rounded py-2 px-3 text-white mt-2">Submit</button>
                            </form>
                            <div class="w-full px-3 mb-6 md:mb-0 my-2">
                                <label class="block tracking-wide text-gray-700 font-bold mb-2"
                                    for="grid-password">
                                    Plain Text: <span class="bg-gray-100 p-1 rounded" id="plainTextEnc"
                                        hidden></span><br>
                                </label>
                                <label class="block tracking-wide text-gray-700 font-bold mb-2"
                                    for="grid-password">
                                    MD5 Hash: <span class="bg-gray-100 p-1 rounded" id="md5HashEnc" hidden></span>
                                    <button class="bg-sky-200 p-1 rounded-lg px-2" id="copyButtonEnc"
                                        hidden>copy</button>
                                </label>
                            </div>
                        </div>
                        <!-- Decryption Section -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <span class="text-lg">MD5 is a hashing method. So, We can't decrypt it.</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('encryptForm').addEventListener('submit', encryptData)

            const plainTextEnc = document.getElementById('plainTextEnc')
            const md5HashEnc = document.getElementById('md5HashEnc')

            const copyButtonEnc = document.getElementById('copyButtonEnc')
            copyButtonEnc.addEventListener('click', () => copyText(md5HashEnc))

            function encryptData(event) {
                console.log('encrypt Data Function called');

                event.preventDefault()
                const rawData = document.getElementById('encryptInput').value

                axios.post('{{ route('hash.encrypt') }}', {
                        encrypt: rawData
                    })
                    .then(function(response) {
                        console.log(response.data.encrypted_data)

                        plainTextEnc.innerHTML = rawData;
                        plainTextEnc.removeAttribute('hidden');

                        md5HashEnc.innerHTML = response.data.encrypted_data;
                        md5HashEnc.removeAttribute('hidden');
                        copyButtonEnc.removeAttribute('hidden');
                    })
                    .catch(function(error) {
                        console.error(error);
                    })
            }

            function copyText(textElementId) {
                const textElement = document.getElementById(textElementId)
                // Create a temporary textarea element
                const textarea = document.createElement('textarea');
                const textToCopy = textElementId.innerText;

                navigator.clipboard.writeText(textToCopy)
                    .then(() => {
                        copyButtonEnc.innerHTML = 'copied'
                    })
                    .catch(err => {
                        console.error('Unable to copy text: ', err);
                    });
            }
        });
    </script>
    @push('scripts')
    @endpush

</x-app-layout>
