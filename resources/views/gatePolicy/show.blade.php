<x-frontend.layouts.master>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <a href="{{ route('posts.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow">Back to List</a>
        <div class="py-8 px-4 max-w-xl mx-auto">
            <h1 class="text-2xl font-semibold mb-2">Post Details</h1>
            <div class="bg-white rounded-lg shadow-2xl p-4 mb-4">
                <p class="text-gray-600 py-4">
                    <strong>{{ $post->user->name }} posted:</strong> <br>
                    "{{ $post->content }}"
                </p>
            </div>
        </div>
    </div>
</x-frontend.layouts.master>
