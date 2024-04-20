<x-frontend.layouts.master>
    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <div class="py-12 px-4 mx-auto max-w-xl">
            @if (session('message'))
                <div class="bg-blue-200 rounded-lg flex">
                    <p class="text-sm px-4 py-3 font-bold">{{ session('message') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-200 rounded-lg flex">
                    <p class="text-sm px-4 py-3 font-bold">{{ session('error') }}</p>
                </div>
            @endif
            {{-- <h1 class="text-3xl font-semibold mb-2">Welcome to Social App</h1> --}}
            <div class="flex justify-between items-center mb-6">
                <div class="space-x-4">
                    <!-- Button to create a post -->
                    <a href="{{ route('posts.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow">Post
                        List</a>

                </div>
            </div>

            <div class="max-w-5xl mx-auto ">
                <div class="container mt-5  max-w-2xl px-4">

                    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-800">Content</label>
                            
                            <input
                                class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                                name="content" value="{{ $post->content ?? old('content') }}">

                            <x-input-error :messages="$errors->first('content')" class="text-red-500 mt-2 font-semibold" />
                        </div>

                        <div class="my-3">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50">Update
                                Post</button>
                            <a href="{{ route('posts.index') }}"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring focus:ring-opacity-50 ml-2">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-frontend.layouts.master>
