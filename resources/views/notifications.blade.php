<x-layout :notifications=$notifications>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
                @if ($notifications->count() > 0)
                    <form action="/markAllAsRead" method="GET">
                        <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Mark all as read
                        </button>
                    </form>
                @endif
            </div>

            <!-- Notification List -->
            <div class="bg-white rounded-lg shadow overflow-hidden ">
                @forelse($notifications as $notification)
                    <div class="border-b border-gray-200 last:border-b-0 ">
                        <a href="{{ $notification->data['url'] ?? '#' }}"
                            class="block px-6 py-4 hover:bg-gray-50 transition duration-150 ease-in-out
                              {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                            <div class="flex items-start">
                                <!-- Icon -->
                                <div class="flex-shrink-0 mr-4 mt-1">
                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="flex justify-between">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $notification->data['title'] ?? 'Notification' }}
                                        </p>
                                        <span class="text-xs text-gray-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ $notification->data['message'] ?? '' }}
                                    </p>
                                </div>

                                <!-- Unread indicator -->
                                @if (!$notification->read_at)
                                    <div class="ml-4 flex-shrink-0">
                                        <span class="h-2 w-2 rounded-full bg-blue-600 block"></span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                        <p class="mt-1 text-sm text-gray-500">You'll see notifications here when you have them.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

</x-layout>
