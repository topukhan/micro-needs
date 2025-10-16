<x-frontend.layouts.master>
    <style>
        .delete-hint {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            pointer-events: none;
            /* Allows clicks to pass through to the parent */
            z-index: 10;
        }
    </style>
    <div class="max-w-4xl mx-auto p-4 h-[calc(100vh-150px)] flex flex-col">
        <!-- Header with User Info -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Live Chat</h1>
                <p class="text-sm text-gray-600">Total Messages: <span id="count">{{ $messages->count() }}</span></p>
            </div>
            <div class="flex items-center space-x-4">
                {{-- add a green button with message generate message and this should go to chat.seed route (get method) --}}
                <form method="GET" action="{{ route('chat.seed') }}" id="seedForm">
                    <input type="hidden" name="message_count" id="inputValue" value="">
                    <button type="button" onclick="showAlertAndSubmit()"
                        class="text-sm text-green-600 hover:text-green-800 bg-green-200 px-4 py-2 rounded">
                        Generate Message
                    </button>
                </form>


                {{-- clear chat button link --}}
                <form method="POST" action="{{ route('chat.clear') }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit"
                        class="text-sm text-red-600 hover:text-red-800 bg-red-200 px-4 py-2 rounded">Clear Chat</button>
                </form>
                <div id="onlineUsers" class="flex items-center space-x-2">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm text-gray-600" id="onlineCount">1 online</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>

        <!-- Chat Container -->
        <div class="flex-1 flex flex-col bg-white rounded-lg shadow-sm overflow-hidden">
            <!-- Messages Area -->
            <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-4">
                @foreach ($messages as $message)
                    <div class="flex flex-col space-y-1 p-1 rounded message-block {{ $message->user_id === Auth::id() ? 'items-end' : 'items-start' }}"
                        data-message-id="{{ $message->id }}">
                        <div
                            class="flex items-end space-x-2 {{ $message->user_id === Auth::id() ? 'flex-row-reverse space-x-reverse' : '' }}">
                            <div
                                class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold">
                                {{ substr($message->user->name, 0, 1) }}
                            </div>
                            <div
                                class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->user_id === Auth::id() ? 'bg-blue-500 text-white rounded-br-none' : 'bg-gray-200 text-gray-800 rounded-bl-none' }}">
                                {{ $message->message }}
                            </div>
                        </div>
                        <div class="flex {{ $message->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <span class="text-xs text-gray-500">
                                {{ $message->user->name }} • {{ $message->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="border-t border-gray-200 p-4">
                <form id="messageForm" class="flex space-x-2">
                    @csrf
                    <input type="text" id="messageInput" placeholder="Type your message..."
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        autocomplete="off" maxlength="1000">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200 font-medium disabled:opacity-50"
                        id="sendButton">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        {{-- 1. Load Pusher JS Library (Required by Echo) --}}
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

        {{-- 2. Load Laravel Echo --}}
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.3/dist/echo.iife.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const messagesContainer = document.getElementById('messages');
                const messageForm = document.getElementById('messageForm');
                const messageInput = document.getElementById('messageInput');
                const sendButton = document.getElementById('sendButton');

                //     window.Echo = new Echo({
                //     broadcaster: 'pusher', // Use 'pusher' for Reverb compatibility
                //     key: "{{ config('broadcasting.connections.reverb.key') }}",
                //     wsHost: "{{ config('broadcasting.connections.reverb.options.host') }}",
                //     wsPort: "{{ config('broadcasting.connections.reverb.options.port') }}",
                //     wssPort: "{{ config('broadcasting.connections.reverb.options.port') }}",
                //     forceTLS: {{ config('broadcasting.connections.reverb.scheme') === 'https' ? 'true' : 'false' }},
                //     enabledTransports: ['ws', 'wss'],
                //     disableStats: true,
                // });


                //     // Listen for chat messages
                //     Echo.channel('chat')
                //         .listen('.message.sent', (e) => {
                //             addMessage(e.chatMessage);
                //         });

                // Rest of your code remains the same...
                messageForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const message = messageInput.value.trim();

                    if (message) {
                        sendButton.disabled = true;
                        sendButton.textContent = 'Sending...';

                        fetch('{{ route('chat.send') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    message: message
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                messageInput.value = '';
                                sendButton.disabled = false;
                                sendButton.textContent = 'Send';
                                location.reload();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                sendButton.disabled = false;
                                sendButton.textContent = 'Send';
                            });
                    }
                });

                // Add message to chat
                function addMessage(messageData) {
                    console.log(messageData);
                    const messageDiv = document.createElement('div');
                    const isOwnMessage = messageData.user_id === {{ Auth::id() }};

                    messageDiv.className =
                        `flex flex-col space-y-1 p-1 message-block ${isOwnMessage ? 'items-end' : 'items-start'}`;
                    messageDiv.innerHTML = `
                    <div class="flex items-end space-x-2 ${isOwnMessage ? 'flex-row-reverse space-x-reverse' : ''}">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold">
                            ${messageData.user.name.charAt(0)}
                        </div>
                        <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                            isOwnMessage 
                                ? 'bg-blue-500 text-white rounded-br-none' 
                                : 'bg-gray-200 text-gray-800 rounded-bl-none'
                        }">
                            ${messageData.message}
                        </div>
                    </div>
                    <div class="flex ${isOwnMessage ? 'justify-end' : 'justify-start'}">
                        <span class="text-xs text-gray-500">
                            ${messageData.user.name} • ${new Date(messageData.created_at).toLocaleTimeString()}
                        </span>
                    </div>
                `;

                    messagesContainer.appendChild(messageDiv);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }

                // Auto-focus input
                messageInput.focus();

                // Scroll to bottom on load
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });

            $(document).ready(function() {
                $('.message-block').on('mouseover', function() {
                    // background color will changes
                    $(this).css({
                        'background-color': '#CBCBCB',
                    });
                    $(this).append('<div class="delete-hint">🗑️ Click to delete</div>');
                }).on('mouseout', function() {
                    // background color will changes
                    $(this).css({
                        'background-color': 'transparent',
                    });
                    $(this).find('.delete-hint').remove();
                })

                // delete on click
                $('.message-block').on('click', function() {
                    // ajax call
                    const messageId = $(this).data('message-id');
                    $.ajax({
                        url: '{{ route('chat.delete', ':id') }}'.replace(':id', messageId),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            // remove message block
                            let count = $('#count').text();
                            $('.message-block[data-message-id="' + messageId + '"]').remove();
                            $('#count').text(parseInt(count) - 1);

                            const deleteMessages = [
                                "🗑️ Deleted!! Don’t worry, it’s all part of the plan!",
                                "💥 Message destroyed! No evidence left—just like magic!",
                                "🎩✨ Poof! Message gone, like it never existed. Abracadabra!",
                                "👋 Bye bye, message! You won’t be seeing it again—ever!",
                                "🧹 Message deleted! Now, don’t even try to remember what it said…",
                                "🔥 Burned to digital ashes! Nothing to see here, folks.",
                                "🚀 Sent to the void! That message is now space dust.",
                                "🧨 Boom! Message obliterated. Mission accomplished.",
                                "🕳️ Whoops! It fell into the internet black hole. Gone forever!",
                                "🔒 Locked and deleted! Even Sherlock couldn’t find it now.",
                                "🌪️ Swiped away by the digital tornado. No traces left!",
                                "🧙‍♂️ *Waves wand* Messageus deletus! (That’s Latin for ‘gone’.)",
                                "🚫 Access denied! That message is now in the digital witness protection program.",
                                "💨 Whoosh! It’s gone faster than your WiFi during a storm.",
                                "🧹💨 Swept away! Clean slate, just like you wanted."
                            ];

                            const randomIndex = Math.floor(Math.random() * deleteMessages.length);
                            toast(deleteMessages[randomIndex], 'success');
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });

            function showAlertAndSubmit() {
                const userInput = prompt("Enter a value for seeding (1-500):");
                if (userInput === null || userInput.trim() === "") {
                    alert("No value entered. Form not submitted.");
                    return;
                }
                const parsedInput = parseInt(userInput, 10);

                if (isNaN(parsedInput) || parsedInput < 1 || parsedInput > 500) {
                    alert("Please enter a valid integer between 1 and 500.");
                    return;
                }
                document.getElementById('inputValue').value = parsedInput;
                document.getElementById('seedForm').submit();
            }
        </script>
    @endpush
</x-frontend.layouts.master>
