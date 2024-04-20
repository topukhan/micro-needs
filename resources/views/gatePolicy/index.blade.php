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
            <div class="flex justify-between items-center mb-6 mt-3">
                <div class="space-x-4">
                    <!-- Button to create a post -->
                    <a href="{{ route('posts.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Create
                        Post</a>

                </div>
            </div>
            <!-- Placeholder content for posts and notifications -->
            <div class="bg-white rounded-lg shadow p-2 my-2">
                <h2 class="text-xl font-semibold mb-4">Latest Posts</h2>
            </div>
            <!-- Example post -->
            @forelse ($posts as $post)
            <div class="bg-white rounded-lg shadow-2xl shadow-rose-400 p-2 my-3">
                <a href="{{ route('posts.show', $post) }}">
                    {{-- <div class="mb-2 px-4"> --}}
                        <p class="text-gray-600 py-4" title="click to view">
                            <strong>{{ $post->user->name }}:</strong> <br>
                            "{{ $post->content }}"
                        </p>
                    </a>
                        <div class="flex items-center justify-between mx-2">
                            <!-- Edit Icon -->
                            <a href="{{ route('posts.edit', $post->id) }}" class="text-gray-600 hover:text-gray-900">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.176" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.176" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                Edit
                            </a>
                            <!-- Delete Icon -->
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete?')" class="text-red-600 hover:text-red-900">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#EF4444"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 11V17" stroke="#EF4444" stroke-width="0.9120000000000001" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 11V17" stroke="#EF4444" stroke-width="0.9120000000000001" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#EF4444" stroke-width="0.9120000000000001" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#EF4444" stroke-width="0.9120000000000001" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#EF4444" stroke-width="0.9120000000000001" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    {{-- </div> --}}
                
            </div>
            @empty
                <div class="mt-2 flex space-x-4">
                    No Post Available
                </div>
            @endforelse
        </div>
    </div>
</x-frontend.layouts.master>
