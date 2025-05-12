<x-layout>
    <div class="p-1 rounded-xl mx-auto w-1/2 my-4 bg-white shadow-2xl flex justify-center flex-col">
        <img src="{{ asset('favicon.ico') }}" class="w-36 h-28 self-center">
        {{-- <h1 class="self-center font-bold text-2xl">Welcome to Task Manager</h1> --}}
        <h1 class="self-center font-bold text-2xl">Create a new account</h1>
        <hr class="border border-gray-300 w-1/2 my-1 self-center">
        <form action="/signup" method="POST" class="mx-auto items-center flex flex-col">
            @csrf
            {{-- First and Last name --}}
            <div class="flex flex-row gap-4 self-center m-4">
                <div class="flex flex-col items-start">

                    <x-input name='first_name' label='First Name' />
                </div>
                <div class="flex flex-col items-start">

                    <x-input name='last_name' label='Last Name' />
                </div>
            </div>
            {{-- Email --}}
            <div class="flex flex-col items-start w-full px-4 self-center mb-2">
                <x-input name='email' label='Email' class="mx-auto" />
            </div>
            {{-- Password --}}
            <div class="flex flex-col items-start w-full px-4 self-center mb-2">

                <x-input name='password' label='Password' class="mx-auto" type='password' />
            </div>
            <div class="flex flex-col items-start w-full px-4 self-center mb-4">
                <x-input name='password_confirmation' type='password' label='Confirm Password' class="mx-auto" />
            </div>
            <x-button type='submit'>Sign Up</x-button>
        </form>
        <div class="text-center text-sm mb-4">
            Already have an account?!
            <a href="/login" class="text-violet-800">SignIn</a>
        </div>
    </div>

</x-layout>
