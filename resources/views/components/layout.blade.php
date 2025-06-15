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
                        <button
                            class="rounded-md py-1 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
                            Add Task
                        </button>
                    </form>
                </div>

                <!-- Navigation Links -->
                <div class="md:flex items-center space-x-6">
                    <a href="/"
                        class="{{ @request()->is('/') ? 'border-b border-b-indigo-400 text-indigo-300 ' : '' }} hover:text-indigo-300 transition-colors px-3 py-2 text-sm font-medium">All
                        Tasks</a>
                    <a href="/Waiting"
                        class="{{ @request()->is('Waiting') ? 'border-b border-b-indigo-400 text-indigo-300 ' : '' }} hover:text-indigo-300 transition-colors px-3 py-2 text-sm font-medium">Waiting</a>
                    <a href="/In Progress" class="{{ @request()->is('In Progress') ? 'border-b border-b-indigo-400 text-indigo-300 ' : '' }} hover:text-indigo-300 transition-colors px-3 py-2 text-sm font-medium">In
                        Progress</a>
                    <a href="/Canceled"
                        class="{{ @request()->is('Canceled') ? 'border-b border-b-indigo-400 text-indigo-300 ' : '' }} hover:text-indigo-300 transition-colors px-3 py-2 text-sm font-medium">Canceled</a>
                    <a href="/Failed" class="{{ @request()->is('Failed') ? 'border-b border-b-indigo-400 text-indigo-300 ' : '' }} hover:text-indigo-300 transition-colors px-3 py-2 text-sm font-medium">Failed
                        To Complete</a>
                </div>

                <!-- Notification Button and User Dropdown -->
                <div class="flex items-center space-x-6">
                    <div x-data="{ notificationsOpen: false }" class="relative">
                        <a id='notificationButton' @click="notificationsOpen = !notificationsOpen" onclick="markAllAsRead()"
                            class="relative p-2 text-gray-300 hover:text-white focus:outline-none hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @foreach ($notifications as $notification)
                                @if ($notifications && !$notification->read_at)
                                    <span id="redDot"
                                        class="absolute top-6 -right-5 h-2 w-2 rounded-full bg-red-500"></span>
                                    @break
                                @endif
                            @endforeach
                        </a>

                        <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-96 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="px-4 py-2 border-b border-gray-200">
                                <h3 class="text-sm font-medium text-gray-900">Notifications</h3>
                            </div>
                            <div class="max-h-60 overflow-y-auto">
                                @if (empty($notifications))
                                    <div class="text-center py-4">
                                        <p class="text-gray-500 text-sm">No notifications.</p>
                                    </div>
                                @endif
                                <!-- Notification items -->
                                @foreach ($notifications as $notification)
                                    <a href="#"
                                        class="block px-4 py-3 text-sm text-gray-700 {{ $notification->read_at ? 'hover:bg-gray-100' : 'bg-gray-200 hover:bg-gray-300' }}  border-b border-gray-100">
                                        <div class="flex items-start">
                                            <div
                                                class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="font-medium text-gray-900">{{ $notification->data['message'] }}
                                                </p>
                                                <p class="text-xs text-gray-500">{{$notification->created_at->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="px-4 py-2 border-t border-gray-200">
                                <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-900">View all
                                    notifications</a>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative ml-4">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none"
                            aria-label="User menu" aria-haspopup="true">
                            <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="text-white">
                                    <path
                                        d="m12 23l-3-3H5q-.825 0-1.412-.587T3 18V4q0-.825.588-1.412T5 2h14q.825 0 1.413.588T21 4v14q0 .825-.587 1.413T19 20h-4zm0-11q1.45 0 2.475-1.025T15.5 8.5t-1.025-2.475T12 5T9.525 6.025T8.5 8.5t1.025 2.475T12 12m-7 6h14v-1.15q-1.35-1.325-3.137-2.087T12 14t-3.863.763T5 16.85z" />
                                </svg>
                            </div>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
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
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
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
    <script>
        async function markAllAsRead() {
            notifications = await fetch('/markAllAsRead', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then((res)=>res.json())
            document.getElementById('redDot').classList.add('hidden')
            document.getElementById('notificationButton').classList.add('disabled')
            console.log("hi",notifications)
        }
    </script>
</body>

</html>
