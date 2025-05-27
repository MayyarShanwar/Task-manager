<x-layout>
    <div x-data="{ open: false }"
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
        <!-- Card Container -->
        <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-white">Create New Task</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <p class="mt-1 text-indigo-100">Fill in the details to schedule your task</p>
            </div>

            <!-- Card Body -->
            <form action="/task" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Task Title</label>
                    <input id="title" name="title" type="text" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="Enter task name">
                </div>
                @error('title')
                    <p class="text-red-600 font-semibold text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror

                <!-- Time Selection -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Start Time -->
                    <div>
                        <label for="time_start" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                        <input id="time_start" name="time_start" type="time" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            value="09:00">
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="time_end" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                        <input id="time_end" name="time_end" type="time" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            value="11:00">
                    </div>
                </div>
                @error('time_end')
                    <p class="text-red-600 font-semibold text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
                @error('time_start')
                    <p class="text-red-600 font-semibold text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror

                <!-- Recurrence -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Task Type</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input @click="open = false" id="one_time_true" name="one_time" type="radio"
                                value="1" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <label for="one_time_true" class="ml-2 text-sm text-gray-700">One Time</label>
                        </div>
                        <div class="flex items-center">
                            <input @click="open = true" id="one_time_false" name="one_time" type="radio"
                                value="0" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500">
                            <label for="one_time_false" class="ml-2 text-sm text-gray-700">Recurring</label>
                        </div>
                    </div>
                </div>


                <!-- Days Selection (Conditional) -->
                <div id="daysContainer" x-show="open">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Recurring Days</label>
                    <div class="grid grid-cols-7 gap-2">
                        @foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day)
                            <div class="flex flex-col items-center">
                                <input type="checkbox" id="day_{{ $day }}" name="days[]"
                                    value="{{ $day }}" class="hidden peer">
                                <label for="day_{{ $day }}"
                                    class="w-full py-2 text-center text-sm rounded-lg border border-gray-300 peer-checked:bg-indigo-600 peer-checked:text-white cursor-pointer">
                                    {{ $day }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('days')
                    <p class="text-red-600 font-semibold text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
                <!-- Single Day Selector (Shown when One-time is selected) -->
                <div id="singleDayContainer" x-show="!open">
                    <label for="day_{{ $day }}" class="block text-sm font-medium text-gray-700 mb-1">Select
                        Day</label>
                    <select id="day_{{ $day }}" name="single_day"
                        class="w-full px-4 py-3 rounded-lg border {{ $errors->has('single_day') ? 'border-red-500' : 'border-gray-300' }} focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        @foreach (['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $value => $label)
                            <option value="{{ $value }}" {{ old('single_day') == $value ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                @error('single_day')
                    <p class="text-red-600 font-semibold text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
