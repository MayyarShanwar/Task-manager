<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Task Management Application">
    <title>Task Manager</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Alpine.js with proper CSP nonce if needed -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Vite assets -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="min-h-full bg-stone-100 flex flex-col">
    @auth
        <header class="bg-gray-900 text-white shadow-lg">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between">
                <!-- Logo and Add Task Button -->
                <div class="flex items-center space-x-6">
                    <a href="/" class="flex items-center space-x-2 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('favicon.ico') }}" alt="Task Manager Logo" class="w-10 h-10">
                        <span class="font-bold text-lg hidden sm:inline">Task Manager</span>
                    </a>
                    
                    <form action="/task" method="get" class="flex items-center">
                        @csrf
                        <button class="rounded-md bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Add Task
                        </button>
                    </form>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="/tasks" class="hover:text-indigo-300 transition-colors px-3 py-2 rounded-md text-sm font-medium">All Tasks</a>
                    <a href="#" class="hover:text-indigo-300 transition-colors px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                </nav>

                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative ml-4">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none" aria-label="User menu" aria-haspopup="true">
                        <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-white">
                                <path d="m12 23l-3-3H5q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v14q0 .825-.587 1.413T19 20h-4zm0-11q1.45 0 2.475-1.025T15.5 8.5t-1.025-2.475T12 5T9.525 6.025T8.5 8.5t1.025 2.475T12 12m-7 6h14v-1.15q-1.35-1.325-3.137-2.087T12 14t-3.863.763T5 16.85z"/>
                            </svg>
                        </div>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                        <div class="border-t border-gray-200 my-1"></div>
                        <form action="/logout" method="POST" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    @endauth

    <main class="flex-grow container mx-auto px-4 py-6">
        {{ $slot }}
    </main>

    @auth
        <footer class="bg-gray-800 text-white py-4 mt-8">
            <div class="container mx-auto px-4 text-center text-sm">
                &copy; {{ date('Y') }} Task Manager. All rights reserved.
            </div>
        </footer>
    @endauth
</body>

</html>