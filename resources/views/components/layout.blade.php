<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-stone-200">
    @auth
        <header class="bg-violet-500 h-1/4 flex justify-between">
        <img src="{{asset('favicon.ico')}}" alt="" class="w-28 ">
        <form action="/logout" method="POST" class="mr-8 mt-1">
            @csrf
            @method('DELETE')
        <button class=" bg-biege rounded-full px-4 font-bold mx-auto my-4 py-2">Log Out</button>
    </form>    
    </header>
    @endauth
    {{$slot}}
</body>
</html>