<x-layout>
    <div class="p-5 rounded-xl mx-auto w-1/2 my-20 bg-white shadow-2xl flex justify-center flex-col">
        <img src="{{ asset('favicon.ico') }}" class="w-40 h-30 self-center">
        <h1 class="self-center font-bold text-2xl">Welcome to Task Manager</h1>
        <hr class="border border-gray-300 w-1/2 my-3 self-center">
        @error('login')
            <p class="text-md text-red-500 mt-1 text-center">{{ $message }}</p>
        @enderror
        <form action="/login" method="POST" class="mx-16 items-center flex flex-col">
            @csrf
            {{-- Email --}}
            <div class="flex flex-col items-start w-full px-4 self-center mb-4">
                <x-input name='email' label='Email' class="mx-auto" />
            </div>
            {{-- Password --}}
            <div class="flex flex-col items-start w-full px-4 self-center mb-4">

                <x-input name='password' label='Password' type='password' class="mx-auto" />
            </div>

            <div class="flex w-full px-4 mb-4 items-center ml-2 gap-1">

                <input name='remember-token' type='checkbox' class="rounded-md" />Remember Me
            </div>
            
            <x-button type='submit'>Login</x-button>
        </form>
        <div class="text-center text-sm">
            Don't have an account?
            <a href="/signup" class="text-violet-800">SignUp</a>
        </div>
    </div>

</x-layout>
