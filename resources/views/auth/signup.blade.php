<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-8">
        <div class="w-full max-w-md mx-4 shadow-2xl">
            <!-- Card Container -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <!-- Header Section -->
                <div class="p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-white shadow-sm mb-4">
                        <img src="{{ asset('favicon.ico') }}" class="w-10 h-10" alt="App Logo">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Create your account</h2>
                    <p class="mt-1 text-sm text-gray-600">Start managing your tasks efficiently</p>
                </div>

                <!-- Form Section -->
                <form action="/signup" method="POST" class="px-6 py-4">
                    @csrf
                    <!-- Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input 
                                name="first_name" 
                                label="First Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="John"
                            />
                        </div>
                        <div>
                            <x-input 
                                name="last_name" 
                                label="Last Name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                placeholder="Doe"
                            />
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <x-input 
                            name="email" 
                            label="Email"
                            type="email"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="your@email.com"
                        />
                    </div>

                    <!-- Password Fields -->
                    <div class="mb-4">
                        <x-input 
                            name="password" 
                            label="Password"
                            type="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="••••••••"
                        />
                    </div>
                    <div class="mb-6">
                        <x-input 
                            name="password_confirmation" 
                            label="Confirm Password"
                            type="password"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="••••••••"
                        />
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-4">
                        <button 
                            type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200"
                        >
                            Create Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center text-sm text-gray-600 mb-2">
                        Already have an account?
                        <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500 ml-1">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>