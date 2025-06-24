<x-layout :notifications=$notifications>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Card Header -->
            <div class="bg-indigo-600 px-6 py-4 text-white">
                <h2 class="text-xl font-semibold">Task Details: {{ $task->title }}</h2>
            </div>

            <!-- Card Body -->
            <div class="p-6 space-y-6">
                <!-- Basic Info Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Title</h3>
                        <p class="mt-1 text-lg">{{ $task->title }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Status</h3>
                        <span
                            class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                            {{ $task->status === 'completed'
                                ? 'bg-green-100 text-green-800'
                                : ($task->status === 'in_progress'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : 'bg-gray-100 text-gray-800') }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                </div>

                <!-- Time Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Start Time</h3>
                        <p class="mt-1">{{ \Carbon\Carbon::parse($task->time_start)->format('h:i A') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">End Time</h3>
                        <p class="mt-1">{{ \Carbon\Carbon::parse($task->time_end)->format('h:i A') }}</p>
                    </div>
                </div>

                <!-- Days Section -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Scheduled Days</h3>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @if ($task->days && count(json_decode($task->days)))
                            @foreach (json_decode($task->days) as $day)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($day) }}
                                </span>
                            @endforeach
                        @else
                            <p class="text-gray-400">No days specified</p>
                        @endif
                    </div>
                </div>

                <!-- Started Status -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Started</h3>
                    <span
                        class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        {{ $task->started ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $task->started ? 'Yes' : 'Not Yet' }}
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <div class="flex space-x-3 pt-4">
                        <form action="/task/{{ $task->id }}/edit" method="get">
                            @csrf
                            @method('PUT')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </button>
                        </form>
                        <form action="/task/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </form>


                    </div>
                    @if (in_array(now()->dayName, json_decode($task->days)) &&
                            now() > $task->time_start &&
                            now() < $task->time_end &&
                            $task->started == 0)
                        <a href="/startTask/{{ $task->id }}" method="get"
                            class="inline-flex items-center px-4 py-2 border bg-green-600 shadow-sm text-sm font-medium rounded-md text-white hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Start The Task
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layout>
