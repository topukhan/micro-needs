<x-frontend.layouts.master>
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
        <!-- Article Header with Hero Image -->
        <div class="bg-white">
            <!-- Simplified Header with Image -->
            <div class="relative bg-gray-100">
                <img src="{{ $article->featured_image ?? 'https://placehold.co/1200x600' }}" alt="{{ $article->title }}"
                    class="w-full h-96 object-cover object-center">
            </div>

            <!-- Content Header -->
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Category and Metadata -->
                <div class="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-600">
                    <span class="px-3 py-1 rounded-full bg-gray-100">
                        {{ $article->category->name ?? 'General' }}
                    </span>
                    <span>{{ $article->published_at->format('F j, Y') }}</span>
                    <span>•</span>
                    <span>{{ $article->reading_time }} min read</span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                <!-- Author -->
                <div class="flex items-center space-x-3">
                    <img class="h-10 w-10 rounded-full" src="https://placehold.co/400/blue/white?text={{ $article->user->name }}" alt="Author">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $article->user->name }}</p>
                        <p class="text-xs text-gray-500">Tech Insights</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl pb-20">
            <div class="text-lg leading-relaxed text-gray-700">
                {!! $article->content !!}
            </div>

            <!-- Tags -->
            @if ($article->tags?->isNotEmpty())
                <div class="mt-12 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">TAGS</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($article->tags as $tag)
                            <a href="#"
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 hover:bg-gray-200 transition-colors">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Author Bio -->
            <div class="mt-12 border-t border-gray-200 pt-8">
                <div class="flex flex-col md:flex-row items-start gap-6 bg-gray-50 rounded-2xl p-6">
                    <div class="flex-shrink-0">
                        <img class="h-20 w-20 rounded-full" src="https://placehold.co/400/blue/white?text={{ $article->user->name }}"
                            alt="Author">
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">About {{ $article->user->name }}</h3>
                        <p class="mt-2 text-gray-600">{{ $article->user->name }} is a senior technology writer with over 10 years of
                            experience covering the latest trends in web development, AI, and cloud computing. When not
                            writing, he enjoys hiking and photography.</p>
                        <div class="mt-4 flex space-x-4">
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                            <a href="https://github.com/topukhan" target="_blank" class="text-gray-500 hover:text-gray-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-700">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if ($relatedArticles?->isNotEmpty())
                <div class="mt-16 border-t border-gray-200 pt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach ($relatedArticles as $related)
                            <div
                                class="group relative flex flex-col overflow-hidden rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="flex-shrink-0">
                                    <img class="h-48 w-full object-cover"
                                        src="{{ $related->featured_image ?? 'https://source.unsplash.com/random/600x400/?tech,blog' }}"
                                        alt="{{ $related->title }}">
                                </div>
                                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-indigo-600">
                                            {{ $related->category->name ?? 'General' }}
                                        </p>
                                        <a href="{{ route('articles.show', $related) }}" class="mt-2 block">
                                            <h3
                                                class="text-xl font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                                {{ $related->title }}
                                            </h3>
                                            <p class="mt-3 text-base text-gray-500 line-clamp-2">
                                                {{ Str::limit(strip_tags($related->content), 120) }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="mt-6 flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://randomuser.me/api/portraits/women/11.jpg" alt="Author">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Jane Smith</p>
                                            <div class="flex space-x-1 text-sm text-gray-500">
                                                <time datetime="{{ $related->published_at->format('Y-m-d') }}">
                                                    {{ $related->published_at->format('M j, Y') }}
                                                </time>
                                                <span aria-hidden="true">&middot;</span>
                                                <span>{{ $related->reading_time }} min read</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Newsletter CTA -->
            <div class="mt-16 bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl shadow-xl overflow-hidden">
                <div class="px-6 py-12 sm:px-12 sm:py-16 lg:py-20 lg:px-16">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="lg:w-0 lg:flex-1">
                            <h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                                Want more articles like this?
                            </h2>
                            <p class="mt-4 max-w-3xl text-lg leading-6 text-indigo-100">
                                Sign up for our newsletter to stay up to date.
                            </p>
                        </div>
                        <div class="mt-8 lg:mt-0 lg:ml-8 space-y-4">
                            <div class="relative rounded-md shadow-sm">
                                <input id="email-address" name="email" type="email" autocomplete="email" required
                                    class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white"
                                    placeholder="Enter your email">
                            </div>
                            <button type="submit"
                                class="block w-full px-4 py-2 text-white bg-gray-800 border border-transparent rounded-md shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                Subscribe
                            </button>
                            <p class="mt-3 text-sm text-gray-600">
                                We care about your data. Read our <a href="#" class="text-gray-900 font-medium underline">Privacy Policy</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Action Buttons -->
        <div class="fixed right-6 bottom-6 flex flex-col space-y-3 z-50">
            <button id="scrollToTop"
                class="p-3 bg-white rounded-full shadow-lg text-gray-700 hover:text-indigo-600 hover:bg-gray-50 transition-all transform hover:scale-110 hidden">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div class="relative group">
                <button
                    class="p-3 bg-indigo-600 rounded-full shadow-lg text-white hover:bg-indigo-700 transition-all transform hover:scale-110">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                    </svg>
                </button>
                <div
                    class="absolute right-0 bottom-full mb-2 hidden group-hover:block w-48 bg-white rounded-lg shadow-lg py-1 z-50">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center">
                        <svg class="h-4 w-4 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                        </svg>
                        Share on Facebook
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center">
                        <svg class="h-4 w-4 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                        </svg>
                        Share on Twitter
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center">
                        <svg class="h-4 w-4 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                        Share on LinkedIn
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Scroll to top button
            const scrollToTopButton = document.getElementById('scrollToTop');

            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollToTopButton.classList.remove('hidden');
                } else {
                    scrollToTopButton.classList.add('hidden');
                }
            });

            scrollToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Copy URL to clipboard
            document.getElementById('copyUrl').addEventListener('click', () => {
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    const tooltip = document.getElementById('copyTooltip');
                    tooltip.classList.remove('hidden');
                    setTimeout(() => {
                        tooltip.classList.add('hidden');
                    }, 2000);
                });
            });
        </script>
    @endpush
</x-frontend.layouts.master>
