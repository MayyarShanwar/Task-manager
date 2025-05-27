<x-layout>
    <div class="max-w-md mx-auto p-8 my-12 bg-white rounded-2xl shadow-lg border border-gray-100">
        <!-- Logo & Heading -->
        <div class="text-center space-y-4">
            <div class="inline-flex items-center justify-center bg-indigo-100 p-4 rounded-full">
                <img src="{{ asset('favicon.ico') }}" class="w-12 h-12" alt="Task Manager Logo">
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Welcome back</h1>
            <p class="text-gray-500">Log in to manage your tasks</p>
        </div>

        <!-- Error Message -->
        @error('login')
            <div class="mt-6 p-3 bg-red-50 text-red-600 rounded-lg text-sm text-center">
                {{ $message }}
            </div>
        @enderror

        <!-- Login Form -->
        <form action="/login" method="POST" class="mt-8 space-y-6">
            @csrf
            <div class="space-y-5">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <x-input 
                        name="email" 
                        id="email"
                        type="email" 
                        placeholder="your@email.com"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    />
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <x-input 
                        name="password" 
                        id="password"
                        type="password" 
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                    />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_token" name="remember_token" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_token" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <div class="text-sm">
                        <a href="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Sign in
                </button>
            </div>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-6 text-center text-sm">
            <p class="text-gray-500">Don't have an account?
                <a href="/signup" class="font-medium text-indigo-600 hover:text-indigo-500 ml-1">Sign up</a>
            </p>
        </div>
    </div>
</x-layout>