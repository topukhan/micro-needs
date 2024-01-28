<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<x-frontend.layouts.partials.head />

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        @stack('outside-main')
        <main class="max-w-7xl mx-auto py-4 pb-6 px-2 sm:px-6 lg:px-8 bg-gray-100">
            {{ $slot }}
        </main>
    </div>
    @stack('script-links')
    @stack('scripts')
</body>

</html>
