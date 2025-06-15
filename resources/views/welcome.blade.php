<x-layout :notifications=$notifications>
    <div class="container mx-auto px-4 py-8">
        @if (!$tasks)
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No tasks found.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($tasks as $task)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h2 class="text-xl font-bold text-indigo-700">{{ $task->title }}</h2>
                                <span
                                    class="px-3 py-1 text-xs rounded-full 
                                {{ $task->status === 'Completed'
                                    ? 'bg-green-100 text-green-800'
                                    : ($task->status === 'In Progress'
                                        ? 'bg-blue-100 text-blue-800'
                                        : 'bg-gray-100 text-gray-800') }}">
                                    {{ Str::headline($task->status) }}
                                </span>
                            </div>

                            <div class="mt-4 flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($task->time_start)->format('h:i A') }} -
                                {{ \Carbon\Carbon::parse($task->time_end)->format('h:i A') }}
                            </div>

                            @if ($task->days)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach (json_decode($task->days) as $day)
                                        <span class="px-2 py-1 bg-indigo-50 text-indigo-700 text-xs rounded-full">
                                            {{ Str::title($day) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    Created {{ $task->created_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-2">

                                    <button class="text-indigo-600 hover:text-indigo-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="/task/{{ $task->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
