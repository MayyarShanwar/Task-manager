@props(['label', 'name', 'type' => 'text'])

@php
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'class' => 'border border-gray-400 rounded-lg w-full h-10 pl-2 text-sm',
        'value' => old($name),
    ];
@endphp


    <label for={{$name}} class="flex justify-center items-center ml-1 text-sm">{{$label}}
    </label>
        <input {{ $attributes($defaults) }} />
        @error($name)
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    
