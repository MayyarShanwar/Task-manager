<x-layout>
    <div class="p-5 rounded-xl mx-auto w-1/2 my-20 bg-white shadow-2xl flex justify-center flex-col text-center">
        <img src="{{asset('favicon.ico')}}" alt="" class="w-20 h-20 self-center my-2">
        <h1>Please verify Your Email</h1>
        <p>We have sent you an email to verify your account</p>
        <p>after you verify your account Please click the button below to log in</p>
        <p>We are very happy to have you as a part of our family</p>
        <a href="http://localhost:8000/login" class="bg-violet-500 border my-4 py-2 w-1/4 self-center rounded-full shadow-xl">Click Here!</a>
        <div class="text-center text-sm mb-2">
            Didn't get the email?!
            <a href="/resend" class="text-violet-800">Send Again!</a>
        </div>
    </div>
</x-layout>
